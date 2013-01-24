<html>
<body>

<form action="uploadfile.php" method="post" enctype="multipart/form-data"
name="uploadImage" id="uploadImage">
<p>
<?php define ('MAX_FILE_SIZE', 1024 * 1024); ?>
  <input type="hidden" name="MAX_FILE_SIZE" 
    value="<?php MAX_FILE_SIZE; ?>" />
  <label for="image">Upload image:</label>
  <input type="file" name="image" id="image" />
</p>
<p>
  <input type="submit" name="upload" id="upload" 
value="Upload" />
</p>
</form>


</body>
</html>

