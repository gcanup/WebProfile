<?php
class CaptchaSecurityImages {

	var $font = 'monofont.ttf';

	function generateCode($characters) {
		/* list all possible characters, similar looking characters and vowels have been removed */
                // To generate Random Number
		$possible = '23456789bcdfghjkmnpqrstvwxyz';
		$code = '';
		$i = 0;
		while ($i < $characters) { 
                        //For substr method take 3 parameter 1st string name 2nd starting value 3rd end value
                        // mt_rand method take 2 parameter starting and ending value
			$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
			$i++;
		}
                
		return $code;
	}

	function CaptchaSecurityImages($width='120',$height='40',$characters='6') {
		$code = $this->generateCode($characters);
		/* font size will be 75% of the image height */
		$font_size = $height * 0.65;
                //Now we need image for that we use imagecreate() method
                //it take 2 parameter 1st is x distance , 2nd is y distance.(i.e. heigth and width) 
		$image = @imagecreate($width, $height) or die('Cannot initialize new GD image stream');
		/* set the colours */
                //To put image color we use imagecolorallocate () method 
                // by default it is in black color it take 2 parameter 
                // 1st name of image and second color value  
		$background_color = imagecolorallocate($image, 255, 255, 255);
		$text_color = imagecolorallocate($image, 138, 19, 119);
		$noise_color = imagecolorallocate($image, 115, 163, 135);
		/* generate random dots in background */
		for( $i=0; $i<($width*$height)/3; $i++ ) {
			imagefilledellipse($image, mt_rand(0,$width), mt_rand(0,$height), 1, 1, $noise_color);
		}
		/* generate random lines in background */
		for( $i=0; $i<($width*$height)/150; $i++ ) {
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		/* create textbox and add text */
		$textbox = imagettfbbox($font_size, 0, $this->font, $code) or die('Error in imagettfbbox function');
		$x = ($width - $textbox[4])/2;
		$y = ($height - $textbox[5])/2;
		imagettftext($image, $font_size, 0, $x, $y, $text_color, $this->font , $code) or die('Error in imagettftext function');
                 /* output captcha image to browser */
                // until this we can't see output for output we use header() fuction and pass content type
		header('Content-Type: image/jpeg');
		//Now we need to return image for that we use imagejpeg() method and pass image.
                imagejpeg($image);
		imagedestroy($image);
                session_start();
                $_SESSION['security_code']=$code;// For Validate we store this value in session
	}

}

$width = isset($_GET['width']) ? $_GET['width'] : '120';
$height = isset($_GET['height']) ? $_GET['height'] : '40';
$characters = isset($_GET['characters']) && $_GET['characters'] > 1 ? $_GET['characters'] : '6';

$captcha = new CaptchaSecurityImages($width,$height,$characters);

?>