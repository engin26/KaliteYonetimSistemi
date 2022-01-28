<? session_start();
$sifre_session=substr(md5(rand(0,999999999999)),-6);
$_SESSION["sifre_session"]=$sifre_session;
$width=80;
$height=15;
$resim=imagecreate($width,$height);
$beyaz=imagecolorallocate($resim,255,255,255);
$rand=imagecolorallocate($resim,rand(0,255),rand(0,255),rand(0,255));
ImageFill($resim,0,0,$rand);
imageString($resim,15,14,0,$sifre_session,$beyaz);
//imageline($resim,100,12,0,12,$beyaz);
header("Content,type:image/png");
imagepng($resim);
imagedestroy($resim); 
?>