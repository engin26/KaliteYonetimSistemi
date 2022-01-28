
  <?php 
  
    include 'header.php';
  ?>
  
       <div class="col-lg-6 col-md-12 col-12">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Anket</title>
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
    <H4 style="color:red; text-align:center;">MÜŞTERİ MEMNUNİYETİ ANKETİ</H4>
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
  
    <div class="card">
  		<div class="card-header">
    		1. Numune kabul işlemleri için kullanılan Başvuru Formları anlaşılır nitelikte mi?
  		</div>
  			<div class="card-body">
        		<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio2" name="radio" value=" (Evet)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio2" >
                        Evet
                		</label>
				</div>      
				<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio3" name="radio" value=" (Kısmen)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio3" >
                        Kısmen	
                		</label>
				</div>        
       			<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio" name="radio" value=" (Hayır)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio" >
                        Hayır	
                		</label>
				</div>
  			</div>
	</div>    
  
  
  
   
    <div class="card">
  		<div class="card-header">
    		2. Numune Kabul Birimi'nde çalışanların müşteri ile iletişimi uygun mu?
  		</div>
  			<div class="card-body">
        		<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio13" name="radio1" value=" (Evet)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio13" >
                        Evet
                		</label>
				</div>      
				<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio14" name="radio1" value=" (Kısmen)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio14" >
                        Kısmen	
                		</label>
				</div>        
       			<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio15" name="radio1" value=" (Hayır)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio15" >
                        Hayır	
                		</label>
				</div>
  			</div>
	</div>    



  
    
    <div class="card">
  		<div class="card-header">
    		3. Başvuruda bulunmadan önce yapılan analiz/test(ler)le ilgili bilgilendirme    	            yeterli	mi?
  		</div>
  			<div class="card-body">
        		<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio16" name="radio2" value=" (Evet)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio16" >
                        Evet
                		</label>
				</div>      
				<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio17" name="radio2" value=" (Kısmen)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio17" >
                        Kısmen	
                		</label>
				</div>        
       			<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio18" name="radio2" value=" (Hayır)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio18" >
                        Hayır	
                		</label>
				</div>
  			</div>
	</div>    

 
    <div class="card">
  		<div class="card-header">
    		4. Kurumun web sitesinde yer alan Analiz/Test ve Kalibrasyon Hizmet Kataloğu 								 			bilgilendirme yönünden yeterli mi?
  		</div>
  			<div class="card-body">
        		<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio19" name="radio3" value=" (Evet)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio19" >
                        Evet
                		</label>
				</div>      
				<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio20" name="radio3" value=" (Kısmen)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio20" >
                        Kısmen	
                		</label>
				</div>        
       			<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio21" name="radio3" value=" (Hayır)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio21" >
                        Hayır	
                		</label>
				</div>
  			</div>
	</div>    


  
    <div class="card">
  		<div class="card-header">
    		5. Verilen hizmetler ile ilgili talep edildiğinde tatmin edici cevaplar 		 	 	  		alınabiliyor mu?
  		</div>
  			<div class="card-body">
        		<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio22" name="radio4" value=" (Evet)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio22" >
                        Evet
                		</label>
				</div>      
				<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio23" name="radio4" value=" (Kısmen)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio23" >
                        Kısmen	
                		</label>
				</div>        
       			<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio24" name="radio4" value=" (Hayır)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio24" >
                        Hayır	
                		</label>
				</div>
  			</div>
	</div>    




    <div class="card">
  		<div class="card-header">
    		6. Yapılan analiz/testlerin çeşitliliği yeterli mi?
  		</div>
  			<div class="card-body">
        		<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio25" name="radio5" value=" (Evet)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio25" >
                        Evet
                		</label>
				</div>      
				<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio26" name="radio5" value=" (Kısmen)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio26" >
                        Kısmen	
                		</label>
				</div>        
       			<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio27" name="radio5" value=" (Hayır)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio27" >
                        Hayır	
                		</label>
				</div>
  			</div>
	</div>    


    <div class="card">
  		<div class="card-header">
    		7. Analiz/Test ücretleri verilen  hizmete uygun mu?
  		</div>
  			<div class="card-body">
        		<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio28" name="radio6" value=" (Evet)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio28" >
                        Evet
                		</label>
				</div>      
				<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio29" name="radio6" value=" (Kısmen)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio29" >
                        Kısmen	
                		</label>
				</div>        
       			<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio30" name="radio6" value=" (Hayır)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio30" >
                        Hayır	
                		</label>
				</div>
  			</div>
	</div>    

  

    <div class="card">
  		<div class="card-header">
    		8. Aldığınız hizmetlere yönelik  şikayetler dinleniyor ve zamanında çözümleniyor 				            mu?
  		</div>
  			<div class="card-body">
        		<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio31" name="radio7" value=" (Evet)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio31" >
                        Evet
                		</label>
				</div>      
				<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio32" name="radio7" value=" (Kısmen)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio32" >
                        Kısmen	
                		</label>
				</div>        
       			<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio33" name="radio7" value=" (Hayır)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio33" >
                        Hayır	
                		</label>
				</div>
  			</div>
	</div>    


    <div class="card">
  		<div class="card-header">
    		9.  Gizlilik, tarafsızlık,  dürüstlük ilkelerine özen gösteriliyor mu?
  		</div>
  			<div class="card-body">
        		<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio34" name="radio8" value=" (Evet)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio34" >
                        Evet
                		</label>
				</div>      
				<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio35" name="radio8" value=" (Kısmen)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio35" >
                        Kısmen	
                		</label>
				</div>        
       			<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio36" name="radio8" value=" (Hayır)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio36" >
                        Hayır	
                		</label>
				</div>
  			</div>
	</div>    
  





    <div class="card">
  		<div class="card-header">
    		10. Aldığınız hizmetlerin (Analiz/Test ,Danışmanlık vb.) güvenilir nitelikte 	   		            olduğunu düşünüyor musunuz?
  		</div>
  			<div class="card-body">
        		<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio37" name="radio9" value=" (Evet)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio37" >
                        Evet
                		</label>
				</div>      
				<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio38" name="radio9" value=" (Kısmen)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio38" >
                        Kısmen	
                		</label>
				</div>        
       			<div class="custom-control custom-radio custom-control-inline">
  					<input type="radio" id="radio39" name="radio9" value=" (Hayır)"
            		class="custom-control-input">
  						<label class="custom-control-label" for="radio39" >
                        Hayır	
                		</label>
				</div>
  			</div>
	</div>    
</br>

 
 
  
    	<div class="input-group">
 			<div class="input-group-prepend">
    			<span class="input-group-text" style="width:100px" >Görüş<br></br> ve<br></br> Önerileriniz</span>
  			</div>
            <div class="input-group-prepend">
    			<span class="input-group-text" >:</span>
  			</div>
  				<textarea id="gorus" name="gorus" class="md-textarea form-control" rows="5">
				<?=$gorus?></textarea>
  		</div>    
</br>
 <div class="col-lg-12 col-md-12 col-12">

       <div class="g-recaptcha" data-sitekey="6LdIewkUAAAAADUwvUpNA08F0Js0v-_4Q99uLyvx" align="center">
       </div>
       </div>
       </br>
  <div class="col-lg-12 col-md-12 col-12" align="center">
          <input type="submit" class="btn btn-lg btn-primary" name="gonder" id="submit" value="Anketi Tamamla" />
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
$radio=$_REQUEST["radio"];
$radio1=$_REQUEST["radio1"];
$radio2=$_REQUEST["radio2"];
$radio3=$_REQUEST["radio3"];
$radio4=$_REQUEST["radio4"];
$radio5=$_REQUEST["radio5"];
$radio6=$_REQUEST["radio6"];
$radio7=$_REQUEST["radio7"];
$radio8=$_REQUEST["radio8"];
$radio9=$_REQUEST["radio9"];

if(!epo($eposta)){hata("Hatalı E-posta girişi.Tekrar deneyiniz");}}

if($adsoyad==""  or $eposta==""  or $_REQUEST["guvenlik"]<>""){hata("$adsoyad,$eposta -Doldurulması zorunlu alan boş.Tekrar deneyiniz.");}


if(!(kol($adsoyad) and kol($adres) and kol($telefon) and kol($gorus) and kol($eposta) and kol($radio)  and kol($radio1)  and kol($radio2)  and kol($radio3)  and kol($radio4)  and kol($radio5)  and kol($radio6)  and kol($radio7)  and kol($radio8)  and kol($radio9)))
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
    <td height="36" colspan="2" align="left"><b>Müşterinin</b></td>
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
  '; if(isset($radio)){$bilgi.='  
  <tr>  
    <td height="30" colspan="2" valign="left">1- Numune kabul işlemleri için kullanılan Başvuru Formları anlaşılır nitelikte mi? '.$radio.'</td>
  </tr>
   ';}; if(isset($radio1)){$bilgi.='
  <tr>
    <td height="30" colspan="2">2- Numune Kabul Biriminde çalışanların müşteri ile iletişimi uygun mu? '.$radio1.'</td>
  </tr>
   ';}; if(isset($radio2)){$bilgi.='
  <tr>
    <td height="30" colspan="2">3- Başvuruda bulunmadan önce yapılan analiz/test(ler)le ilgili bilgilendirme yeterli mi? '.$radio2.'</td>
  </tr>
   ';}; if(isset($radio3)){$bilgi.='
  <tr>
    <td height="30" colspan="2">4- Kurumun web sitesinde yer alan Analiz/Test ve Kalibrasyon Hizmet Kataloğu bilgilendirme yönünden yeterli mi? '.$radio3.'</td>
  </tr>
 ';}; if(isset($radio4)){$bilgi.='
  <tr>
    <td height="30" colspan="2">5- Verilen hizmetler ile ilgili talep edildiğinde tatmin edici cevaplar alınabiliyor mu? '.$radio4.'</td>
  </tr>
   ';}; if(isset($radio5)){$bilgi.='
  <tr>
    <td height="30" colspan="2">6-Yapılan analiz/testlerin çeşitliliği yeterli mi? '.$radio5.'</td>
  </tr>
   ';}; if(isset($radio6)){$bilgi.='
  <tr>
    <td height="30" colspan="2">7- Analiz/Test ücretleri verilen hizmete uygun mu? '.$radio6.'</td>
  </tr>
   ';}; if(isset($radio7)){$bilgi.='
  <tr>
    <td height="30" colspan="2">8-Aldığınız hizmetlere yönelik şikayetler dinleniyor ve zamanında çözümleniyor mu? '.$radio7.'</td>
  </tr>
   ';}; if(isset($radio8)){$bilgi.='
  <tr>
    <td height="30" colspan="2">9- Gizlilik, tarafsızlık, dürüstlük ilkelerine özen gösteriliyor mu? '.$radio8.'</td>
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
$mail->Password = "klt.0394T";
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
      <p><b class="style2">Anketimize katıldığınız ve değerli önerilerinizi bizimle paylaştığınız için teşekkür ederiz.<br />
        </p>
    </div>';
session_destroy();
} } }else{echo formgoster();}
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
