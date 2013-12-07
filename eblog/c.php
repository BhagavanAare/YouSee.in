<?
/**
 * @author Marcelo Santamaria
 * @since Sep 15, 2010
 */
 
   function generateCode($characters) {
      /* list all possible characters, similar looking characters and vowels have been removed */
      $possible = '23456789';
      $code = '';
      $i = 0;
      while ($i < $characters) { 
         $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
         $i++;
      }
      return $code;
   }
	// generate random number and store in variable
 
	$randomnr = generateCode(6);


        $dstat = stat(dirname(__FILE__));
         setcookie("_c", crypt(crypt("$randomnr", substr("$randomnr", 0, 2)), "" . $dstat['mtime']), 0, "/");

	//generate image
        $width = 130;
        $height = 40;
	$im = imagecreatetruecolor($width, $height);
 
	//colors:
	$white = imagecolorallocate($im, 0, 0, 0);
	$grey = imagecolorallocate($im, 128, 128, 128);
	$black = imagecolorallocate($im, 255, 255, 255);
 
	imagefilledrectangle($im, 0, 0, 200, 40, $black);

         /* generate random dots in background */
      for( $i=0; $i<($width*$height)/3; $i++ ) {
         imagefilledellipse($im, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $grey);
      }
      /* generate random lines in background */
      for( $i=0; $i<($width*$height)/130; $i++ ) {
         imageline($im, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $grey);
      }
 
	//path to font:
 
	$font = 'c.ttf';
 
	//draw text:
	
 
	imagettftext($im, 30, 0, 20, 30, $white, $font, $randomnr);
 
	// prevent client side  caching
	header("Expires: Wed, 1 Jan 1997 00:00:00 GMT");
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
 
	//send image to browser
	header ("Content-type: image/gif");
	imagegif($im);
	imagedestroy($im);



?>
