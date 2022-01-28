
  <?php 
  
    include 'header.php';
  ?>
  
       <div class="col-lg-6 col-md-12 col-12">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Bize Yazın</title>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	
<?
include('../../../../v3.0/data/kepce.php');
kepce_veri();
session_start();
session_register("adsoyad");
session_register("adres");
session_register("telefon");
session_register("gorus");
session_register("eposta");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?

function kol($kontes) {
if(ereg("['|$~*<>?]", $kontes))
return FALSE;
	else 
return TRUE;
}

function hata($yazi){ 
global  $hatasayac,$hatalar; 
if($yazi<>""){
$hatasayac++;$hatalar.=$hatasayac." : ".$yazi."<br>";}
return array($hatasayac,$hatalar);}
function epo($eposta){
return (preg_match('/\\b[A-Z0-9._%-]+@[A-Z0-9._%-]+\\.[A-Z]{2,4}\\b/i', $eposta)) ? true : false;}
function turkce($tck)
          {			$tck=str_replace("ı","I",$tck);
                    $tck=str_replace("i","İ",$tck);
                    $tck=str_replace("ü","Ü",$tck);
                    $tck=str_replace("ö","Ö",$tck);
                    $tck=str_replace("ş","Ş",$tck);
                    $tck=str_replace("ğ","Ğ",$tck);
                    $tck=str_replace("ç","Ç",$tck);
            return $tck;
}
function formgoster($hatalar){ 
	global $adsoyad,$adres,$telefon,$eposta,$gorus,$hatalar;
 ?>

 
 
 <div class="col-lg-12 col-md-12 col-12">
<form id="form1" name="form1" method="post" action="">
<table  border="0" cellpadding="0" cellspacing="0" width="inherit">
 </br>
  <div class="card" style="width:inherit">
  <div class="card-body" >
    <H4 style="color:red; text-align:center;">Bize YAZIN</H4>
  </div>
</div>
 </br>
  
  		<div class="input-group">
 			<div class="input-group-prepend">
    			<span class="input-group-text" style="width:92px">Adı Soyadı</span>
  			</div>
             <div class="input-group-prepend">
    			<span class="input-group-text" >:</span>
  			</div>
  				<input type="text"  name="adsoyad"  id="adsoyad" class="form-control" value="<?=$adsoyad?>">
  		</div>
   
  
    	<div class="input-group">
 			<div class="input-group-prepend">
    			<span class="input-group-text" style="width:92px">Adres</span>
  			</div>
            <div class="input-group-prepend">
    			<span class="input-group-text" >:</span>
  			</div>
  				<input type="text"  name="adres"  id="adres" class="form-control" value="<?=$adres?>">
  		</div>

    
    	<div class="input-group">
 			<div class="input-group-prepend">
    			<span class="input-group-text" style="width:92px">Telefon</span>
  			</div>
            <div class="input-group-prepend">
    			<span class="input-group-text" >:</span>
  			</div>
  				<input type="text"  name="telefon"  id="adi2" class="form-control" value="<?=$telefon?>">
  		</div>
   
    	<div class="input-group" style="width:100%">
 			<div class="input-group-prepend">
    			<span class="input-group-text" style="width:92px">E-mail</span>
  			</div>
            <div class="input-group-prepend">
    			<span class="input-group-text" >:</span>
  			</div>
  				<input type="email"  name="email"  id="adi" class="form-control"  value="<?=$eposta?>">
  		</div>
  </br>


 
 
  
    	<div class="input-group">
 			<div class="input-group-prepend">
    			<span class="input-group-text" style="width:100px" >İstek<br></br> ve<br></br> Sorularınız</span>
  			</div>
            <div class="input-group-prepend">
    			<span class="input-group-text" >:</span>
  			</div>
  				<textarea id="gorus" name="gorus" class="md-textarea form-control" rows="15">
				<?=$gorus?></textarea>
  		</div>    
</br>
 <div class="col-lg-12 col-md-12 col-12">

       <div class="g-recaptcha" data-sitekey="6LdIewkUAAAAADUwvUpNA08F0Js0v-_4Q99uLyvx" align="center">
       </div>
       </div>
       </br>
  <div class="col-lg-12 col-md-12 col-12" align="center">
          <input type="submit" class="btn btn-lg btn-primary" name="gonder" id="submit" value="GÖNDER" />
          </div>
     </br></br></br>
 
 
 
 
  </tr>
  <tr>
    <td align="center"><?=$hatalar;?></td>
  </tr>
</table>
 </div>

</form>


<? 

}
if($_REQUEST["gonder"]=="Anketi Tamamla"){
kepce_spam();
include('../../../iletisim/iptarih.php');
$dakka=1;
$time3=$tarihzaman-$dakka;
$tarih=strftime("%d/%m/%Y %H:%M");
include('../../../iletisim/mysqlconnect.php');
mysql_query("delete from kisi where time<$time3");
$varm=mysql_query("select * from kisi where ip='$apm' and sayfa='kalite'");
$varmi=mysql_fetch_array($varm);
if(mysql_num_rows($varm)>0)
{echo "<br><br><br><center>Yeni bir kaydı ".$dakka." dakika sonra yapabilirsiniz.<br><br></center>";
?> <center><a href="javascript:history.back(1)">&laquo;&laquo;&nbsp;GERİ</a></center>  <?  }
elseif ($_POST["gonder"]<>"Anketi Tamamla") 
{echo formgoster();} else{

$adsoyad=strtoupper(turkce($_POST["adsoyad"]));
$adres=$_POST["adres"];
$telefon=$_POST["telefon"];
$eposta=$_POST["email"];
$gorus=$_POST["gorus"];


if(!epo($eposta)){hata("Hatalı E-posta girişi.Tekrar deneyiniz");}}

if($adsoyad==""  or $eposta==""  or $_REQUEST["guvenlik"]<>""){hata("$adsoyad,$eposta -Doldurulması zorunlu alan boş.Tekrar deneyiniz.");}


if(!(kol($adsoyad) and kol($adres) and kol($telefon) and kol($gorus) and kol($eposta) ))
{hata("Forma hatalı veri girişi.Tekrar deneyiniz.");}

//if($_REQUEST["guvenlik"]!=$_SESSION["sifre_session"] and $_REQUEST["guvenlik"]!=""){hata("Güvenlik kodunu yanlış girdiniz.");}
list($hatasayac,$hatalar)=hata();

if($hatasayac>=1){echo formgoster($hatalar);}else
{ 
$bilgi='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Mail</title>
</head>
<body>
<table width="800" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="36" colspan="2" align="left"><b>Mforüşterinin</b></td>
  </tr>
  <tr>
    <td width="93" height="24" align="left">&nbsp;Adı Soyadı</td>
    <td width="507">: '.$adsoyad.'</td>
  </tr>
  <tr>
    <td width="93" height="24" align="left">&nbsp;Tarih</td>
    <td width="507">: '.$tarih.'</td>
  </tr>

  <tr>
    <td width="93" height="24" align="left">&nbsp;Adres</td>
    <td width="507">: '.$adres.'</td>
  </tr>
  <tr>
    <td width="93" height="24" align="left">&nbsp;Telefon</td>
    <td width="507">: '.$telefon.'</td>
  </tr>
  <tr>
    <td width="93" height="24" align="left">&nbsp;Email</td>
    <td width="507">: '.$eposta.'</td>
  </tr>
   <tr>
    <td width="93" height="24" align="left">&nbsp;Tarih ve Ip Adresi</td>
    <td width="607">: '.$time."--".$apm.'</td>
  </tr>
  
   ';}; if(isset($radio9)){$bilgi.='
  <tr>
    <td height="30" colspan="2">10- Aldığınız hizmetlerin (analiz/test ,danışmanlık vb.) güvenilir nitelikte olduğunu düşünüyor musunuz? '.$radio9.'</td>
  </tr>';};
  $bilgi.='<tr>
    <td height="69" align="center">Görüş ve önerileriniz<b>:</b> </td>
    <td height="69">'.$gorus.'</td>
  </tr>
</table>

</body>

</html>';


 
date_default_timezone_set('Etc/UTC');
require '/var/www/html/v3.0/mail_gonder/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = "posta.mta.gov.tr";
$mail->Port = 25;
$mail->SMTPAuth = true;
$mail->Username = "kalite@mta.gov.tr";
$mail->Password = "AB0394T.kal";
$mail->setFrom('kalite@mta.gov.tr', 'Gönderen Kişi');
$mail->addAddress('kalite@mta.gov.tr', 'Alıcı Kişi');
$mail->Subject = 'Müşteri Memnuniyeti Anketi';
$mail->msgHTML($body);
$mail->Body.=$bilgi;

//send the message, check for errors
if (!$mail->send()) {
    echo "Mesajınız Gönderilemedi.!" . $mail->ErrorInfo;
} else {
    echo '<div align="center"><span class="style6">
      <p><b class="style2">Bilgileriniz kayıtlarımıza alınmıştır. </b></p>
      <p><b class="style2">En kısa sürede tarafınıza dönüş yapılacaktır.<br />
        </p>
    </div>';
session_destroy();
 } }else{echo formgoster();}
?> 





 

	</div><!-- #wrapper -->
    <?php include 'sol_menu.php'; ?>
    </div>
	

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


</body>
</html>


      </div>
      
      
    </div>
  </div>
