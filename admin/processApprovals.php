<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

if (isset($_POST['donorSubmit'])) 
{
	echo "submitted <br />";
	$counter=0;
	 while($count)
	 {

		 $userid=$useridArray[$counter];		 
		 echo " count=".$count." counter=".$counter." userid=".$userid."<br />";

		 $counter++;
		 $radioID="action".$userid;
		 $value=$_POST[$radioID];
		 if($value=="A")
		 {
			 echo $userid." approved";
		 }
		 $count=$count-1;
	 }
}

?>
</body>
</html>