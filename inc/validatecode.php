<?php	
	$rndNum=rand(1000,9999);
	$strNum=strval($rndNum);
	$_SESSION['gBlog_validatecode']=$strNum;
	$im=imagecreate(60,25);
	$bakColor=imagecolorallocate($im,0xF3,0xF3,0xF3);
	$blue=imagecolorallocate($im,0,255,0);
	$red=imagecolorallocate($im,255,0,0);
    $orange=imagecolorallocate($im,0,0,255);
	$c1=imagecolorallocate($im,0xF7,0x68,0x09);
	$c2=imagecolorallocate($im,0x99,0,0);
	$c3=imagecolorallocate($im,0x73,0xA2,0xDE);

	$textColor=array($blue,$red,$orange,$c1,$c2,$c3);
	for($i=0;$i<strlen($strNum);$i=$i+1)
	{
		imagestring($im,4,8+$i*11,5,substr($strNum,$i,1),$textColor[rand(0,count($textColor)-1)]);
	}

	header('Content-type:image/png');
	imagepng($im);
	imagedestroy($im);
?>