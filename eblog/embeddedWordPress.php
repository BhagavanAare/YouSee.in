<?php

include_once("class.WordPressClient.php");

//
// String Constants
//
define("NAV_LABEL_LATEST", 		"Latest");
define("NAV_LABEL_HELP", 		"Help");
define("NAV_LABEL_WRITE", 		"Write");
define("NAV_LABEL_LOGIN", 		"Admin Login");
define("NAV_LABEL_LOGOUT", 		"Logout");
define("NAV_LABEL_EDIT", 		"Login");

define("DEFAULT_POST_TITLE", 		"Enter a Descriptive Title for your New Blog Entry");
define("DEFAULT_POST_CONTENT", 		"Blog here.");

define("WRITE_TITLE", 			"Write a New Blog Entry");
define("EDIT_TITLE", 			"Edit an Existing Blog Entry");
define("LOGIN_TITLE", 			"Blog Login");

// -------------------------------------------------------------------------------------------
// BEGIN SlideShare WordPress Plugin Adapter
//
define("SS_WIDTH", 425);
define("SS_HEIGHT", 348);
define("SS_REGEXP", "/\[slideshare ([[:print:]]+)\]/");

define("SS_TARGET", "<p><object type=\"application/x-shockwave-flash\" data=\"https://s3.amazonaws.com:443/slideshare/ssplayer.swf?\"###ss_mu###\" width=\"".SS_WIDTH."\" height=\"".SS_HEIGHT."\"><param name=\"movie\" value=\"https://s3.amazonaws.com:443/slideshare/ssplayer.swf?\"###ss_mu###\" /></object></p>");

function slideshare_replace($match)
{
        $match[1] = str_replace("&w=425", "", $match[1]);
        $output = SS_TARGET;
        $output = str_replace("###ss_mu###", $match[1], $output);
        $output = str_replace('"','',$output);
        return ($output);
}

// 
// END SlideShare WordPress Plugin Adapter
// -------------------------------------------------------------------------------------------

// -------------------------------------------------------------------------------------------
// BEGIN function prettyTimestamp()
//
function prettyTimestamp($timespec) {
    // return gmstrftime("%B %d, %Y at %I:%M %p", strtotime($timespec));
    return strftime("%B %d, %Y at %I:%M %p %Z", strtotime($timespec));
}
// 
// END function prettyTimestamp()
// -------------------------------------------------------------------------------------------

// -------------------------------------------------------------------------------------------
// BEGIN function verifyCaptcha()
//
function verifyCaptcha() {

    global $errstr;
    global $dstat;

    $captcha = $_POST['captcha'];	// must be submitted as a POST parameter
    $storedCaptcha = $_COOKIE['_c'];

    $result = FALSE;

    if (empty($storedCaptcha)) {
        $errstr .= "Please re-enter the spam verification code. (Do you have cookies enabled?)<br/>";
    }
    else {
        if (empty($captcha) || (strlen(trim($captcha)) == 0)) { 
            $errstr .= "Please re-enter the spam verification code.<br/>";
        } 
        else {
            if (crypt(crypt($captcha, substr($captcha, 0, 2)), "" . $dstat['mtime']) == $storedCaptcha) {
                $cookieExpire = time() - (3600*72);
?>
<script type="text/javascript">
var exp_date = new Date(<?php echo $cookieExpire; ?>);
document.cookie="_c=;expires=" + exp_date.toGMTString();
</script>
<?php
                $result = TRUE;
            }
            else {
                $errstr .= "Please re-enter the spam verification code.<br/>";
            }
        }
    }

    return $result;
}
// 
// END function verifyCaptcha()
// -------------------------------------------------------------------------------------------

// -------------------------------------------------------------------------------------------
// BEGIN function insertLoginForm() 
//
function insertLoginForm($nextAction, $nextSlug) {
    global $basePageURL;
    global $errstr;
    //chmod(dirname(__FILE__), 0755);
?>
<script type="text/javascript">
function renewcap(){
                     
                     document.getElementById('captcha').src = '/eblog/c.php?r='+ Math.floor(Math.random()*111111)
                     
                     }
</script>
<div class="loginForm">
<div style="font-size: 125%; padding: 0 0 10px; text-align: left; font-weight: bold;"><?php echo LOGIN_TITLE; ?></div>
 <?php if ($errstr) { ?><div class="errorArea"><?php echo $errstr;?></div><?php } ?>
 <form method="post" action="<?php echo $basePageURL; ?>">
  <p>
  <label style="font-weight: bold;">Username</label>
  <input type="text" name="username" id="username" value="" size="20" tabindex="1">
  </p>
  <p>
  <label style="font-weight: bold;">Password</label>
  <input type="password" name="password" id="password" value="" size="20" tabindex="2">
  </p>
  <p>
  <label style="font-weight: bold;">Spam Verification</label>
  <div id="contentcaptcha"><div id="imagecaptcha"><label for="captcha-image" id="captcha-image"><img id="captcha" src="/eblog/c.php?r=<?php echo rand(0,999999)?>" alt="Spam Verification Code" border="0"/></label></div>
  <div id="buttonrefresh"><input type="button"  id="renewcaptcha" value="" onclick="javascript:document.getElementById('captcha').src = '/eblog/images/loading.gif' ;setTimeout('renewcap()',1000);" ></div>
  </div> <!-- end div contentcaptcha -->
  <div id="textcaptcha"><input type="text" name="captcha" id="captcha" value="" size="6" tabindex="3"> (Enter the numbers shown in the above image)</div>
  </p>
  <input type="hidden" name="a" value="li">
  <?php if ($nextAction) { ?><input type="hidden" name="na" value="<?php echo $nextAction; ?>"><?php } ?>
  <?php if ($nextSlug) { ?><input type="hidden" name="s" value="<?php echo $nextSlug; ?>"><?php } ?>
  <p><input name="login" type="submit" id="loginSubmit" tabindex="5" value="Login"></p>
 </form>
</div>
<?php
}
// 
// END function insertLoginForm()
// -------------------------------------------------------------------------------------------

// -------------------------------------------------------------------------------------------
// BEGIN function insertPostEditor() 
//
function insertPostEditor($editorTitle, $ptitle, $pcontent, $postid = -1) {
    global $action;
    global $errstr;
    global $apSuccess;
    global $basePageURL;
    if (empty($ptitle)) $ptitle = DEFAULT_POST_TITLE;
    if (empty($pcontent)) $pcontent  = DEFAULT_POST_CONTENT;
?>
<script type="text/javascript" src="/eblog/tiny_mce/tiny_mce_gzip.js"></script>
<script type="text/javascript">
tinyMCE_GZ.init({
   plugins : 'style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,'+ 
   'searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras',
   themes : 'simple,advanced',
   languages : 'en',
   disk_cache : true,
   debug : false
});
</script>
<script type="text/javascript">
tinyMCE.init({
   mode : "exact",
   editor_selector : "mceEditor",
   elements : "blogEditor",
   theme : "advanced",
   plugins : "media,inlinepopups",
   dialog_type : "modal",
   theme_advanced_toolbar_location : "top",
   theme_advanced_path_location : "bottom",
   theme_advanced_toolbar_align : "center",
   theme_advanced_resizing : true,
   theme_advanced_resize_horizontal : false,
   theme_advanced_buttons1 : "cut,copy,paste,undo,redo,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,bullist,numlist,outdent,indent",
   theme_advanced_buttons2 : "anchor,link,unlink,image,media,hr,blockquote,|,fontselect,fontsizeselect,forecolor,backcolor,|,sub,sup,charmap",
   theme_advanced_buttons3 : "",
   convert_newlines_to_brs : false,
   remove_linebreaks : true,
   force_p_newlines : false,
   force_br_newlines : false,
   forced_root_block : false,
   gecko_spellcheck : true,
   button_tile_map : true,
   inline_styles : true,
   convert_fonts_to_spans : true
});
</script>
<?php 
    if ($action == "ap") {
        if (is_numeric($apSuccess)) { 
?>
<div class="successStatus">
  Your new blog entry was successfully published 
  (<a style="color: #ffffff;" href="<?php echo $basePageURL; ?>">click to view</a>).
</div>
<?php 
        } 
        if (!empty($apSuccess) && !is_numeric($apSuccess)) 
            $errstr = "Sorry, your post could not be submitted (" . $apSuccess . ")";
    }
    if ($action == "ep") {
        if (is_numeric($epSuccess)) { 
?>
<div class="successStatus">
  Your blog entry was successfully updated 
  (<a style="color: #ffffff;" href="<?php echo $basePageURL; ?>">post #<?php echo $epSuccess; ?></a>).
</div>
<?php 
        }
        if (!empty($epSuccess) && !is_numeric($epSuccess)) 
            $errstr = "Sorry, your post could not be submitted (" . $epSuccess . ")";
    } 
    if ($errstr) { 
?>
<div class="errorArea"><?php echo $errstr;?></div>
<?php 
    } 
?>
<div style="font-size: 125%; padding: 10px; text-align: left; font-weight: bold;"><?php echo $editorTitle; ?></div>
<form name="blogEditForm" style="padding: 20px; text-align:left;" method="post">
  <label style="font-weight: bold;">Title</label>
  <input type="text" name="title" id="title" value="<?php echo $ptitle; ?>" size="60" tabindex="1">
  <p><textarea id="blogEditor" name="content" cols="60" rows="25"><?php echo $pcontent; ?></textarea></p>
  <p style="align: right;"><input type="submit" name="<?php 
    if ($action == "ep") 
        echo "previewEditBlog"; 
    else
        echo "previewNewBlog";
?>" value="Preview"></p>
  <input type="hidden" name="a" value="<?php echo $action; ?>">
  <input type="hidden" name="postid" value="<?php echo $postid; ?>">
</form>
<?php
}
// 
// END function insertPostEditor()
// -------------------------------------------------------------------------------------------

// -------------------------------------------------------------------------------------------
// BEGIN function embedBlog()
//
function embedBlog($appID) {

    // default view = show recent posts;  non-default view = show specific post
    $defaultView = FALSE; 	

    global $basePageURL;
    $basePageURL = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?'));

    // request-level error string, normally FALSE unless error
    global $errstr;
    $errstr = FALSE;

    // comment fields
    $cAuthor = FALSE;
    $cEmail = FALSE;
    $cComment = FALSE;
    $acSuccess = FALSE;

    // add post status
    global $apSuccess;
    $apSuccess = FALSE;

    // edit post status
    global $epSuccess;
    $epSuccess = FALSE;

    // request-level logged-in status attributes
    global $loggedIn;
    global $loggedInUsername;
    global $loggedInPassword;
    $loggedIn = FALSE;

    // action for the request
    global $action;
    if (isset($_REQUEST['a'])){
    $action = $_REQUEST['a'];
            }

    global $dstat;
    $dstat = stat(dirname(__FILE__));

    // initialize the WordPress client object
    $blog = new WordPressClient($appID);

    // --------------------------------------------------------------------------------------
    // Action:  Login
    //
    if ($action == "li") { 
    
        $username = (empty($_POST['username']))? $_POST['username'] = null : $_POST['username'];
        $password = (empty($_POST['password']))? $_POST['password'] = null : $_POST['password'];
        $nextAction = (empty($_POST['na']))? $_POST['na'] = null : $_POST['na'];
        $nextSlug = (empty($_POST['s']))? $_POST['s'] = null : $_POST['s'];
        
        if (empty($_POST['login']) || ($_POST['login'] != "Login")) {
            insertLoginForm($nextAction, $nextSlug);
            return;
        }

        if (empty($username) || (strlen(trim($username)) == 0) ||
            empty($password) || (strlen(trim($password)) == 0)) {
            $errstr .= "Invalid username and/or password.<br/>";
            insertLoginForm($nextAction, $nextSlug);
            return;
        }

        if (verifyCaptcha() && empty($errstr)) {
            $md5Password = md5(md5($password)); // double hash
            $loggedIn = $blog->validateCredentials($username, $md5Password);
            if ($loggedIn) {
                $pCookie = urlencode($md5Password);
?>
<script type="text/javascript">
document.cookie="_uu=<?php echo $username; ?>";
document.cookie="_up=<?php echo $pCookie; ?>";
</script>
<?php
                $loggedInUsername = $username;
                $loggedInPassword = $md5Password;
                $action = $nextAction;
            }
            else {
                $errstr = "Invalid username and/or password.<br/>";
                insertLoginForm($nextAction, $nextSlug);
                return;
            }
        }
        else {
            insertLoginForm($nextAction, $nextSlug);
            return;
        }
    }

    // --------------------------------------------------------------------------------------
    // Action:  Logout
    //
    if ($action == "lo") { 
        $loggedIn = FALSE;
        $cookieExpire = time() - (3600*72);
?>
<script type="text/javascript">
var exp_date = new Date(<?php echo $cookieExpire; ?>);
document.cookie="_uu=;expires=" + exp_date.toGMTString();
document.cookie="_up=;expires=" + exp_date.toGMTString();
</script>
<?php
    }

    // --------------------------------------------------------------------------------------
    // Check if logged in
    //
    if (!$loggedIn && ($action != "lo") && isset($_COOKIE['_uu']) && isset($_COOKIE['_up'])) {
        $loggedIn = $blog->validateCredentials($_COOKIE['_uu'], $_COOKIE['_up']);
        $loggedInUsername = $_COOKIE['_uu'];
        $loggedInPassword = $_COOKIE['_up'];
    }

    // ------------------------------------------------------------------------------------
    // Do we have posts to render?
    //
    if ($action != "ap") {
        $posts = array();

       if(isset($_REQUEST['s'])){
        $slug = $_REQUEST['s'];
        }
        if (!empty($slug)) {
            $posts = $blog->getPostBySlug($slug);
        }
    
        if (sizeof($posts) < 1) {
            $posts = $blog->getRecentPosts(50);
            $defaultView = TRUE;
        }
    }

    // ------------------------------------------------------------------------------------
    // Dynamically create upper right hand navigation
    // don't show nav if we need to be logged in for a given action
    //
    if (!(($action == "ap" || $action == "ep") && !$loggedIn)) {
?>
<div class="blogNav">
<?php
      if ($loggedIn) {
?>
Logged in as: <span style="font-weight:bold;"><?php echo $loggedInUsername; ?></span> |
<?php
      }
      if (!$defaultView) { 
?>
<a href="<?php echo $basePageURL; ?>"><?php echo NAV_LABEL_LATEST; ?></a> | 
<?php 
      } 
      if ($loggedIn) { 
          if ($action != "ap") { 
?> 
<a href="<?php echo $basePageURL . "?a=ap"; ?>"><?php echo NAV_LABEL_WRITE; ?></a> | 
<?php 
          }
          // add dynamic Help link
          if ($action == "ap" || $action == "ep") { 
?>
<a href="http://www.embeddedblogs.com/write.php" target="_blank"><?php echo NAV_LABEL_HELP; ?></a> | 
<?php
          }
          else if (!$defaultView) {
?>
<a href="http://www.embeddedblogs.com/manage.php" target="_blank"><?php echo NAV_LABEL_HELP; ?></a> | 
<?php
          }
          else {
?>
<a href="http://www.embeddedblogs.com/home.php" target="_blank"><?php echo NAV_LABEL_HELP; ?></a> | 
<?php
          }
?>
<a href="<?php echo $basePageURL . "?a=lo"; ?>"><?php echo NAV_LABEL_LOGOUT; ?></a>
<?php
      }  // end if $loggedIn
      else {
?>
<a href="<?php echo $basePageURL . "?a=li"; ?>"><?php echo NAV_LABEL_LOGIN; ?></a>
<?php
      }
?>
</div>
<?php
    }
?>

<?php
    // --------------------------------------------------------------------------------------
    // Action:  Add a New Blog Entry
    //
    if ($action == "ap") {
        if (!$loggedIn) {
            insertLoginForm("ap", "");
        }
        else {
            if (!empty($_POST['previewNewBlog'])) {
                $title = stripslashes($_POST['title']);
                $content = stripslashes($_POST['content']);
?>
<div class="post">
 <span style="color: #c00000; font-size: 125%; font-weight: bold;">[PREVIEW]</span> <a style="font-size: 125%; font-weight: bold;" href=""><?php echo $title; ?></a>
 <div class="entry">
  <p><?php echo $content; ?></p>
 </div>
<hr>
<span style="text-align: center; padding: 10px;">
 <form method="post">
  <input type="hidden" name="title" value="<?php echo urlencode($title); ?>">
  <input type="hidden" name="content" value="<?php echo urlencode($content); ?>">
  <input type="hidden" name="a" value="ap">
  <input type="submit" name="publishNewBlog" value="Publish Now!">
 </form>
</span>
</div>
<?php               
                return;
            }
            if (!empty($_POST['publishNewBlog'])) {
                $apSuccess = $blog->addPost($loggedInUsername, $loggedInPassword, $_POST['title'], $_POST['content'], '', TRUE);
                if (!$apSuccess) { 
                    insertPostEditor(WRITE_TITLE, urldecode($_POST['title']), urldecode($_POST['content'])); 
                }
            }
            insertPostEditor(WRITE_TITLE, FALSE, FALSE); // use default editor values
        }
        return;		
    }

    // --------------------------------------------------------------------------------------
    // Action:  Edit an Existing Blog Entry
    //
    if ($action == "ep") {
        if (!$loggedIn) {
            insertLoginForm("ep", $slug);
        }
        else {
            if (!empty($_POST['previewEditBlog'])) {
                $title = stripslashes($_POST['title']);
                $content = stripslashes($_POST['content']);
                $postid = $_POST['postid'];
?>
<div class="post">
 <span style="color: #c00000; font-size: 125%; font-weight: bold;">[PREVIEW]</span> <a style="font-size: 125%; font-weight: bold;" href=""><?php echo $title; ?></a>
 <div class="entry">
  <p><?php echo $content; ?></p>
 </div>
<hr>
<span style="text-align: center; padding: 10px;">
 <form method="post">
  <input type="hidden" name="title" value="<?php echo urlencode($title); ?>">
  <input type="hidden" name="content" value="<?php echo urlencode($content); ?>">
  <input type="hidden" name="a" value="ep">
  <input type="hidden" name="postid" value="<?php echo $postid; ?>">
  <input type="submit" name="publishEditBlog" value="Publish Now!">
 </form>
</span>
</div>
<?php               
                return;
            }
            if (!empty($_POST['publishEditBlog'])) {
                $postid = $_POST['postid'];
                $epSuccess = $blog->editPost($loggedInUsername, $loggedInPassword, $postid, $_POST['title'], $_POST['content'], '', TRUE);
                if (!$epSuccess) { 
                    insertPostEditor(EDIT_TITLE, urldecode($_POST['title']), urldecode($_POST['content']), $postid); 
                }
                else {
                    // success!  zero out action, reload specific post
                    $action = "";
                    $posts = $blog->getPostBySlug($slug);
                }
            }
        }
    }

    // --------------------------------------------------------------------------------------
    // Action:  Add a Comment
    //
    if ($action == "ac") {
        $cAuthor = strip_tags($_POST['author']);
        $cEmail = $_POST['email'];
        $cComment = $_POST['comment'];
        $cPostID = $_POST['postid'];

        if (empty($cAuthor) || (strlen(trim($cAuthor)) == 0)) 
            $errstr .= "Please enter your name.<br/>";
        if (empty($cEmail) || (strlen(trim($cEmail)) == 0) || !strrpos($cEmail, "@"))
            $errstr .= "Please enter your email address.<br/>";
        if (empty($cComment) || strlen(trim($cComment)) == 0) {
            $errstr .= "Please enter a comment.<br/>";
        }
        else{
            $cComment = str_replace("\'", "'", $cComment);
        }
        if (empty($cPostID) || strlen(trim($cPostID)) == 0) 
            $errstr .= "Unknown Post ID.  Please try again.<br/>";

        if (!$errstr) {
            if (verifyCaptcha()) {
                $commentdata = array(
                                   'comment_post_ID' => $cPostID,
                                   'comment_author' => $cAuthor,
                                   'comment_author_email' => $cEmail,
                                   'comment_author_url' => '',
                                   'comment_content' => $cComment,
                                   'comment_type' => 'comment',
                                   'user_ID' => '',
                                   'comment_author_IP' => preg_replace( '/[^0-9., ]/', '',$_SERVER['REMOTE_ADDR'] ),
                                   'comment_agent' => $_SERVER['HTTP_USER_AGENT']
                               );

                $comment_id = $blog->addComment( $commentdata );

                if (is_numeric($comment_id)) {
                    $acSuccess = TRUE;
                    $posts = $blog->getPostBySlug($slug);
                }
                else {
                    $errstr = "Sorry, your comment could not be posted (" . $comment_id . ")";
                }
            }
        }
    }

    // --------------------------------------------------------------------------------------
    // Action:  Delete a Post
    //
    if ($action == "dp") { 
        if (!$loggedIn) {
            insertLoginForm("", $slug);
        }
        else {
            $postid = $_REQUEST['pid'];

            if (!empty($postid)) {
                $dpResult = $blog->deletePost( $loggedInUsername, $loggedInPassword, $postid );
                if ($dpResult) { 
                    $posts = $blog->getRecentPosts(50);
                    $defaultView = TRUE;
                }
                else {
                    $errstr = "Error while attempting to delete post ($dpResult)";
                    echo $errstr;
                }
            }
        }
    }

    // --------------------------------------------------------------------------------------
    // Action:  Approve or Delete a Comment
    //
    if ($action == "dc" || $action == "apc") {
        if (!$loggedIn) {
            insertLoginForm("", $slug);
        }
        else {
            $cID = $_REQUEST['cid'];

            if (!empty($cID)) {
                if ($action == "dc")  $actionName = "delete";
                if ($action == "apc") $actionName = "approve";
              
                $cResult = $blog->setCommentStatus( $loggedInUsername, $loggedInPassword, $cID, $actionName);
                if ($cResult) { 
                    $posts = $blog->getPostBySlug($slug);
                }
                else {
                    $errstr = "Error while attempting to " . $actionName . " comment ($dcResult)";
                    echo $errstr;
                }
            }
        }
    }

    // --------------------------------------------------------------------------------------
    // handle the case where no blog entries are found.
    //
    if (!$posts || empty($posts) || !is_array($posts) || sizeof($posts) == 0) {
        echo "<div class=\"post\">No blog entries found.</div>";
        return;
    }

    // ------------------------------------------------------------------------------------
    // Render the post(s)
    //
    foreach ($posts as $post) {
        $postid = $post['postid'];
        $content = $post['description'];
        $content = preg_replace_callback(SS_REGEXP, 'slideshare_replace', $content);
        // $content = str_replace("\n\n", "<p>", $content);
        // $content = str_replace("\n", "<br>", $content);

        //
        // if we're editing a post, push the content into the blog editor
        //
        if ($action == "ep") {
            if (!$loggedIn) {
                insertLoginForm("ep", "" . $post['wp_slug']);
            }
            else {
                insertPostEditor(EDIT_TITLE, $post['title'], $content, $postid);
            }
            return;
        }

        $ccount = $post['comment_count'];
        $commentStr = "No Comments";
        if ($ccount > 0) {
            $commentStr = "$ccount comment";
            if ($ccount > 1) $commentStr .= "s";
        }

        if ($loggedIn) {
            $newccount = $post['unapproved_comment_count'];
            $commentStr .= " (" . $newccount . " new)";
        }

        $permalink = $basePageURL . "?s=" .  $post['wp_slug']; 
?>
<div class="post">
 <a style="font-size: 125%; font-weight: bold;" href="<?php echo $permalink; ?>"><?php echo $post['title']; ?></a>
<?php 
        if ($loggedIn) {
?>
<span style="font-size: 100%;">[ <a style="font-size: 100%;" href="<?php echo $permalink . "&a=ep"; ?>">edit</a> | <a style="font-size: 100%;" href="<?php echo $basePageURL . "?a=dp&pid=" . $postid; ?>" onclick="return confirm('You are about to delete this post.\n\'Cancel\' to stop, \'OK\' to delete.');">delete</a> ]</span>
<?php
        }
?>
 <div class="postinfo">
  By <?php echo $post['wp_author_display_name']; ?> | <?php echo prettyTimestamp($post['dateCreated']); ?> | <a href="<?php echo $permalink; ?>#comments"><?php echo $commentStr; ?></a><br>
 </div>
 <div class="entry">
  <p><?php echo $content; ?></p>
 </div>
 <!-- <?php // echo var_export($post); ?> -->
</div>
<?php
        // ------------------------------------------------------------------------------------
        // if viewing a single slug, show the comments
        if (!$defaultView) {
?>
 <div class="comments" id="comments">
<?php 
            if ($ccount > 0 || $loggedIn) {
?>
  <div class="commentsHeader"><?php echo $commentStr; ?> | <a href="#commentform">Add a New Comment</a></div>
<?php
            }
?>
<?php
            $cIdx = 0;
            $prevCommentID = "comments";
            foreach ($post['comments'] as $comment) {
                $newComment = ($comment['comment_approved'] != 1);
                if (!$newComment || $loggedIn) {	// show all comments if logged in
                    $cIdx++;
                    $commentID = $comment['comment_ID'];
                    $commentContent = "<p>" . $comment['comment_content'];
                    $commentContent = preg_replace_callback(SS_REGEXP, 'slideshare_replace', $commentContent);
                    $commentContent = str_replace("\n\n", "<p>", $commentContent);
                    $commentContent = str_replace("\n", "<br>", $commentContent);
                    $commentContent = str_replace("\'", "'", $commentContent);
                    $commentContent .= "</p>";
?>
  <div class="comment" id="comment-<?php echo $commentID; ?>" <?php if ($newComment) { ?> style="background-color: #e4ffff;" <?php } ?>>
   <div class="commentHeader">
    <?php echo $cIdx . ". " . $comment['comment_author']; ?> | <?php echo prettyTimestamp($comment['comment_date']); ?>
<?php 
        if ($loggedIn) {
?>
    <span class="newCommentControls">[ <?php if ($newComment) { ?><a href="<?php echo $permalink . "&a=apc&cid=" . $commentID . "#" . $prevCommentID; ?>">approve</a> | <?php } ?><a href="<?php echo $permalink . "&a=dc&cid=" . $commentID . "#" . $prevCommentID; ?>" onclick="return confirm('You are about to delete this comment by \'<?php echo $comment['comment_author']; ?>\'.\n\'Cancel\' to stop, \'OK\' to delete.');">delete</a> ]</span>
<?php 
        }
?>
   </div>
   <div class="commentContent">
    <?php echo $commentContent; ?>
   </div>
  </div>
<?php
                    $prevCommentID = "comment-" . $commentID;
                }
            }

            // ------------------------------------------------------------------------------------
            // Render the comment form
            //
?>
<div class="commentform" id="commentform">
 <div class="commentformHeader">Add a <?php if ($ccount > 0) echo "New";?> Comment</div>
 <?php if (!$acSuccess && $errstr) { ?><div class="errorArea"><?php echo $errstr;?></div><?php } ?>
 <?php if ($acSuccess) { ?><div class="successStatus">Thank you for your comment.  Your comment will be published after the owner of this blog approves it.</div><?php } ?>
 <form method="post" action="#commentform">
  <p>
  <label for="author">Name</label>
  <input type="text" name="author" id="author" value="<?php if (!$acSuccess && $cAuthor) echo $cAuthor; ?>" size="22" tabindex="1">
  </p>
  <p>
  <label for="email">EMail Address (will not be published)</label>
  <input type="text" name="email" id="email" value="<?php if (!$acSuccess && $cEmail) echo $cEmail; ?>" size="40" tabindex="2">
  </p>
  <p>
  <label for="captcha">Spam Verification</label>
  <label for="captcha-image"><img src="/eblog/c.php?r=<?php echo rand(0,999999)?>" alt="Spam Verification Code" border="0"/></label>
  <input type="text" name="captcha" id="captcha" value="" size="6" tabindex="3"> (Enter the numbers shown in the above image)
  </p>
  <p>
  <label for="comment">Comment</label>
  <textarea name="comment" id="comment" cols="60" rows="10" tabindex="4"><?php if (!$acSuccess && $cComment) echo $cComment; ?></textarea>
  </p>
  <p><input name="sc" type="submit" id="submitComment" tabindex="5" value="Submit Comment"></p>
  <input type="hidden" name="a" value="ac">
  <input type="hidden" name="postid" value="<?php echo $post['postid']; ?>">
 </form>
</div>
<?php
        }

    }
}
// 
// END function embedBlog()
// -------------------------------------------------------------------------------------------

?>
