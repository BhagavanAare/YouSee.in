<?php
require_once("xmlrpc.php");

/* 
    Simple example:
    
    include_once("class.WordPressClient.php");

    $username = "whoever";
    $password = "password";
    
    $blog = new WordPressClient($username, $password);
    $postid = "8450106";
    
    $myPost = $blog->getPost($postid);
*/

class WordPressClient {

    var $appID = "";
    var $bServer = "205.178.136.112";
    var $bPath = "/wordpress/xmlrpc.php";
    var $apiName = "blogger";			// default API namespace
    var $wpapiName = "wp";			// WordPress API namespace
    var $mwapiName = "metaWeblog";		// MetaWeblog API namespace
    var $netsolapiName = "netsol";		// Netsol API namespace
    var $blogClient;
    var $XMLappID;
    var $XMLusername;
    var $XMLpassword;

    function WordPressClient($appID)
    {
        if ($appID != "APPID") {
            $this->bServer = $appID . ".blogs.appgadgets.com";
            $this->bPath = "/xmlrpc.php";
        }

        // Connect to wordpress server
        if (!$this->connectToBlogger()) {
            return false;
        }

    	// Create variables to send in the message
    	$this->XMLappID	   = new xmlrpcval($appID, "string");
    	
    	return $this;
    }

    function getUsersBlogs()
    {
    	// Construct query for the server
        $r = new xmlrpcmsg($this->apiName . ".getUsersBlogs", array($this->XMLappID, $this->XMLusername, $this->XMLpassword));
    	// Send the query
    	$r = $this->exec($r);
    	return $r;
    }

    function getUserInfo()
    {
        $r = new xmlrpcmsg($this->apiName . ".getUserInfo", array($this->XMLappID, $this->XMLusername, $this->XMLpassword));
        $r = $this->exec($r);
        return $r;
    }
        
    function getPost($postID)
    {
        $XMLpostid = new xmlrpcval($postID, "string");
        $r = new xmlrpcmsg($this->apiName . ".getPost", array($this->XMLappID, $XMLpostid, $this->XMLusername, $this->XMLpassword));
    	$r = $this->exec($r);
        return $r;
    }

    function newPost($blogID, $username, $password, $textPost, $publish=false)
    {
        $XMLblogid = new xmlrpcval($blogID, "string");
        $XMLcontent = new xmlrpcval($textPost, "string");
        $XMLpublish = new xmlrpcval($publish, "boolean");
        $XMLusername = new xmlrpcval($username, "string");
        $XMLpassword = new xmlrpcval($password, "string");

        $r = new xmlrpcmsg($this->apiName . ".newPost", array($this->XMLappID, $XMLblogid, $XMLusername, $XMLpassword, $XMLcontent, $XMLpublish));
    	$r = $this->exec($r);
        return $r;
    }
        
    function getTemplate($blogID, $template="main")
    {
        $XMLblogid = new xmlrpcval($blogID, "string");
        $XMLtemplate = new xmlrpcval($template, "string");
        $r = new xmlrpcmsg($this->apiName . ".getTemplate", array($this->XMLappID, $XMLblogid, $this->XMLusername, $this->XMLpassword, $XMLtemplate));
    	$r = $this->exec($r);
        return $r;
    }
        
    function setTemplate($blogID, $template="archiveIndex")
    {
        $XMLblogid = new xmlrpcval($blogID, "string");
        $XMLtemplate = new xmlrpcval($template, "string");
        $r = new xmlrpcmsg($this->apiName . ".setTemplate", array($this->XMLappID, $XMLblogid, $this->XMLusername, $this->XMLpassword, $XMLtemplate));
    	$r = $this->exec($r);
        return $r;
    }

    // 
    // BEGIN Netsol XML RPC API functions
    // 

    //
    //
    //
    function hello()
    {
        $r = new xmlrpcmsg("netsol.hello");
    	$r = $this->exec($r);
        return $r;
    }

    //
    //
    //
    function getRecentPosts($numPosts)
    {
        $XMLnumPosts = new xmlrpcval($numPosts, "int");
	
        $r = new xmlrpcmsg($this->netsolapiName . ".getRecentPosts", array($this->XMLappID, $XMLnumPosts));
    	$r = $this->exec($r);

        return $r;
    }
        
    //
    //
    //
    function getPostBySlug($slug)
    {
        $XMLslug = new xmlrpcval($slug, "string");
	
        $r = new xmlrpcmsg($this->netsolapiName . ".getPostBySlug", array($this->XMLappID, $XMLslug));
    	$r = $this->exec($r);

        return $r;
    }
        
    //
    //
    //
    function validateCredentials($username, $password)
    {
        $XMLusername = new xmlrpcval($username, "string");
        $XMLpassword = new xmlrpcval($password, "string");
	
        $r = new xmlrpcmsg($this->netsolapiName . ".validateCredentials", array($this->XMLappID, $XMLusername, $XMLpassword));
    	$r = $this->exec($r);

        // if the credentials are good, check for version updates
        if ($r) { 
            $this->checkForUpdates();
        }

        return $r;
    }
        
    //
    //
    //
    function addComment($commentdata)
    {
        $XMLcomment_post_ID       = new xmlrpcval($commentdata['comment_post_ID'],       "int");
        $XMLcomment_author        = new xmlrpcval($commentdata['comment_author'],        "string");
        $XMLcomment_author_email  = new xmlrpcval($commentdata['comment_author_email'],  "string");
        $XMLcomment_author_url    = new xmlrpcval($commentdata['comment_author_url'],    "string");
        $XMLcomment_content       = new xmlrpcval($commentdata['comment_content'],       "string");
        $XMLcomment_type          = new xmlrpcval($commentdata['comment_type'],          "string");
        $XMLuser_ID               = new xmlrpcval($commentdata['user_ID'],               "int");
        $XMLcomment_author_IP     = new xmlrpcval($commentdata['comment_author_IP'],     "string");
        $XMLcomment_agent         = new xmlrpcval($commentdata['comment_agent'],         "string");
	
        $r = new xmlrpcmsg($this->netsolapiName . ".addComment", 
                           array(
                                 $this->XMLappID, 
                                 $XMLcomment_post_ID,
                                 $XMLcomment_author,
                                 $XMLcomment_author_email,
                                 $XMLcomment_author_url,
                                 $XMLcomment_content,
                                 $XMLcomment_type,
                                 $XMLuser_ID,
                                 $XMLcomment_author_IP,
                                 $XMLcomment_agent
                                )
                          );
    	$r = $this->exec($r);

        return $r;
    }
        
    //
    //
    //
    function setCommentStatus($username, $password, $commentID, $status)
    {
        $XMLusername = new xmlrpcval($username, "string");
        $XMLpassword = new xmlrpcval($password, "string");
        $XMLcommentid = new xmlrpcval($commentID,  "int");
        $XMLstatus = new xmlrpcval($status, "string");

        $r = new xmlrpcmsg($this->netsolapiName . ".setCommentStatus", array($this->XMLappID, $XMLusername, $XMLpassword, $XMLcommentid, $XMLstatus));
    	$r = $this->exec($r);
        return $r;
    }

    //
    //
    //
    function addPost($username, $password, $title, $content, $category, $publish)
    {
        $XMLusername = new xmlrpcval($username, "string");
        $XMLpassword = new xmlrpcval($password, "string");
        $XMLtitle    = new xmlrpcval($title,    "string");
        $XMLcontent  = new xmlrpcval($content,  "string");
        $XMLcategory = new xmlrpcval($category, "string");
        $XMLpublish  = new xmlrpcval($publish,  "boolean");
	
        $r = new xmlrpcmsg($this->netsolapiName . ".addPost", array($this->XMLappID, $XMLusername, $XMLpassword, $XMLtitle, $XMLcontent, $XMLcategory, $XMLpublish));
    	$r = $this->exec($r);

        return $r;
    }
        
    //
    //
    //
    function editPost($username, $password, $postid, $title, $content, $category, $publish)
    {
        $XMLusername = new xmlrpcval($username, "string");
        $XMLpassword = new xmlrpcval($password, "string");
        $XMLpostid   = new xmlrpcval($postid,   "int");
        $XMLtitle    = new xmlrpcval($title,    "string");
        $XMLcontent  = new xmlrpcval($content,  "string");
        $XMLcategory = new xmlrpcval($category, "string");
        $XMLpublish  = new xmlrpcval($publish,  "boolean");

        $r = new xmlrpcmsg($this->netsolapiName . ".editPost", array($this->XMLappID, $XMLusername, $XMLpassword, $XMLpostid, $XMLtitle, $XMLcontent, $XMLcategory, $XMLpublish));
    	$r = $this->exec($r);
        return $r;
    }
        
    //
    //
    //
    function deletePost($username, $password, $postid)
    {
        $XMLusername = new xmlrpcval($username, "string");
        $XMLpassword = new xmlrpcval($password, "string");
        $XMLpostid = new xmlrpcval($postid, "int");
        $r = new xmlrpcmsg($this->netsolapiName . ".deletePost", array($this->XMLappID, $XMLusername, $XMLpassword, $XMLpostid));
    	$r = $this->exec($r);
        return $r;
    }
        
    //
    // Silent Auto Update
    //
    function checkForUpdates() {
        //this fix the folder permission - Marcelo Santamaria 01-11-2010
        //chmod(dirname(__FILE__), 0755);
      try {
        $baseURL = "http://" . $this->bServer . substr($this->bPath, 0, strpos($this->bPath, "xmlrpc.php")) . "eblog-repo/";

	//$latestVersion = file_get_contents($baseURL . "LATEST");

	$curl_handle=curl_init();
	curl_setopt($curl_handle,CURLOPT_URL,$baseURL."LATEST");
	curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,100);
	curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,true);
	curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, true);
	$content = curl_exec($curl_handle);
	curl_close($curl_handle);

	$latestVersion = $content;


        if (preg_match('/^(\d+)\.(\d+)\.(\d+)\.(\d+)$/', $latestVersion)) {
            $latestVersion = trim($latestVersion);

            $currentVersionFilename = dirname(__FILE__) . "/VERSION";
            if (file_exists($currentVersionFilename)) {
                $currentVersion = file_get_contents($currentVersionFilename);
                $currentVersion = trim($currentVersion);
            }
            else {
                $currentVersion = "";
            }

            if ($latestVersion != $currentVersion) { 
                $distroFilename = "eblog-" . $latestVersion . ".tar.gz";
                $localFilename = dirname(__FILE__) . "/" . $distroFilename;
                $ch = curl_init($baseURL . $distroFilename);
                $fh = fopen($localFilename, "w");
                curl_setopt($ch, CURLOPT_FILE, $fh);
                $curlRes = curl_exec($ch);
                curl_close($ch);
                fclose($fh);

                $fstat = stat($localFilename);

                if ($fstat['size'] > 0) {
                    // echo "Successfully downloaded version $latestVersion ($localFilename).\n";

                    $cmd1 = "gzip -d $localFilename";
                    // echo $cmd1 . "\n";
                    //UNZIP by GZIP
                    //`$cmd1`;
                     $handlezip = popen($cmd1.' 2>&1', 'r');
                     $outputzip = null;
                     while( !feof($handlezip) ) {
                     $outputzip .=fread($handlezip,4096);
                        }
                     return $outputzip;


                    $localFilename = substr($localFilename, 0, strpos($localFilename, ".gz"));
                    $cmd2 = "cd " . dirname(__FILE__) . "; tar -xf $localFilename";
                    // echo $cmd2 . "\n";
                    //UNTAR eblog file update
                    //`$cmd2`;
                     $handletar = popen($cmd2.' 2>&1', 'r');
                     $outputtar = null;
                     while( !feof($handletar) ) {
                     $outputtar .=fread($handletar,4096);
                        }
                     return $outputtar;
                    //DELTE the tar file
                     if ( file_exists($localFilename)){
                     unlink($localFilename);
                     }
                     if ( file_exists($distroFilename)){
                    unlink($distroFilename);
                    }
                    
                     
                    // echo "Installed version $latestVersion ($localFilename).\n";

                    if (file_put_contents($currentVersionFilename, $latestVersion) != FALSE) {
                        // echo "CURRENT version updated to $latestVersion\n";
                    }
                }
                else {
                    // echo "LATEST version found ($latestVersion), but unable to download $distroFilename.\n";
                }
            }
            else { 
                // echo "Nothing to do -- we're up to date!\n";
                if ( file_exists($localFilename)){
                     unlink($localFilename);
                     }
                     if ( file_exists($distroFilename)){
                    unlink($distroFilename);
                    }
            }
        }
        else {
            // echo "No LATEST version found.\n";
        }
      }
      catch (Exception $e) { 
          // echo "Exception caught: " . var_export($e);
      }
    }

    // 
    // END Netsol XML RPC API functions
    // 

    // class helper functions
    // Returns a connection object to the wordpress server
    function connectToBlogger() {
    	if($this->blogClient = new xmlrpc_client($this->bPath, $this->bServer)) {
    		return true;
    	}
    	else {
    		return false;
    	}
    }

    function exec($req)
    {
    	// Send the query
    	$result_struct = $this->blogClient->send($req);
    	
    	$r = $this->errTest($result_struct);
    	
    	return $r;
    }        
    
    function errTest($result_struct)
    {
    	// Check the results for an error
    	if (!$result_struct->faultCode()) {
    		// Get the results in a value-array
    		$values = $result_struct->value();
    		
    		// Compile results into PHP array
    		$result_array = wp_xmlrpc_decode($values);
    		
    		// Check the result for error strings.
    		$valid = wordpress_checkFaultString($result_array);
    		
    		// Return something based on the check
    		if ($valid == true) {
    			$r = $result_array;
    		}
    		else {
    			$r = $valid;
    		}
    	}
    	else {
    		 $r = $result_struct->faultString();
    	}
        
        return $r;
    }

    // Added by Beau Lebens of DentedReality 2002-02-03
    // Return the HTML required to make a form select element which is made up in the form
    // $select[$blogid] = $blogName;
    // If the user only has one blog, then it returns a string containing the name of the blog
    // in plain text, with a hidden form input containing the blogid, using the same
    // $name as it would have for the select
    function getUsersBlogsSelect($name="blog", $selected="", $extra="")
    {
        $getUsersBlogsArray = $this->getUsersBlogs();
        
    	foreach($getUsersBlogsArray as $blog) {
    		if (is_string($blog)) {
    			return false;
    		}
    		$blogs_select[$blog["blogid"]] = str_replace("&lt;", "<", $blog["blogName"]);
    	}
    	if (sizeof($blogs_select) > 1) {
    		return display_select($name, $blogs_select, $selected, $extra);
    	}
    	else {
    		return $getUsersBlogsArray[0]["blogName"] . " <input type=\"hidden\" name=\"$name\" value=\"" . $getUsersBlogsArray[0]["blogid"] . "\">";
    	}
    }

}

function wordpress_checkFaultString($wordpressResult) {
   if (isset($wordpressResult)){
	if (isset($wordpressResult["faultString"])) {
		return $wordpressResult["faultString"];
	}
	//else if (strpos($wordpressResult, "java.lang.Exception") !== false) {
        else if (@preg_match("java.lang.Exception", $wordpressResult)) 
                              //!== false) 
                     {
      
		     return $wordpressResult;
	}
	else {
		return true;
	}
    }
}

function display_select($name, $options, $value = 0, $misc = "unset") {
	$select = "<select";
	if (strlen($name)) {
		$select .= " name=\"" . $name . "\"";
	}
	if (is_array($misc)) {
		while (list($id, $val) = each($misc)) {
			$select .= " " . $id . "=\"" . $val . "\"";
		}
	}
	$select .= ">";
	if (is_array($options)) {
		while (list($id, $val) = each($options)) {
			$select .= "\n<option";
			$select .= " value=\"" . $id . "\"";
			if (strcmp($id, $value))
				$select .= ">";
			else
				$select .= " selected>";
			$select .= htmlspecialchars($val) . "</option>";
		}
	}
	$select .= "\n</select>\n";
	return $select;
}

// A generic debugging function, parses a string/int or array and displays contents
// in an easy-to-read format, good for checking values during a script's execution
function debug($value) {
	$counter = 0;
	echo "<table cellpadding=\"3\" cellspacing=\"0\" border=\"0\" style=\"border: solid 1px #000000; background: #EEEEEE; width: 95%; margin: 20px;\" align=\"center\">\n";
	echo "<tr>\n<td colspan=\"3\" style=\"font-family: Arial; font-size: 13pt; font-weight: bold; text-align: center;\">Debugging Information</td>\n</tr>\n";
	if ( is_array($value) ) {
		echo "<tr>\n<td>&nbsp;</td>\n<td><b>Array Key</b></td>\n<td><b>Array Value</b></td>\n</tr>\n";
		foreach($value as $key=>$val) {
			if (is_array($val)) {
				debug($val);
			}
			else {
				echo "<tr>\n<td>$counter</td>\n<td>&nbsp;" . $key . "&nbsp;</td>\n<td>&nbsp;" . $val . "&nbsp;</td>\n</tr>\n";
			}
			$counter++;
		}
	}
	else {
		echo "<tr>\n<td colspan=\"3\">" . $value . "</td>\n</tr>\n";
	}
	echo "</table>\n";
}

// missing convenience function
// getUserRecentPosts($blogID, $numUserPosts, $checkInPosts);

?>
