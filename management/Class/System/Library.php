<?php
	class Library extends Defined{

		function trDate($date){
			return date("d.m.Y", strtotime($date));
		}

		function DbDate($date){
			return date("Y-m-d", strtotime($date));
		}
		function RevNoAdd($revNo){
			if ($revNo<10) {
				$revNo='0'.$revNo ;
			}

			return $revNo;
		}


		public static function Random($Number)
		{
			if($Number == '') $Number = 5;
			$Rand = '';
			$Char = "abcdefghijklmnoprstuvyzABCDEFGHIJKLMNOPRSTUVYZ123456789";
			for ($i=1;$i<=$Number;$i++)
			{
				$random = rand(1,strlen($Char)-1);
				$Rand.=$Char[$random];
			}
			return $Rand;
		}

		public function WebMail($ID)
		{
			// WebMail Tablosuna eklenen Kayıtlardan Kendisi Sunucusunu Arar Eşleştirdiğinde Onun Bilgilerini Alır
			DB::select("ID, UserName, Password, Host, Port");
			DB::table("WebMail");
			DB::where_array(array("WHERE"	=>	"Server = '".gethostname()."'"));
			$line = DB::get();

			return $line;

		}
		public function Settings($ID)
		{
			DB::select("*");
			DB::table("Settings");
			DB::where_array(array("WHERE"	=>	"ID = '".$ID."'"));
			$line = DB::get();

			return $line;
		}
		public static function TRMoney($str = 0)
		{
			$str    =    number_format($str,2,".",",");
			return $str;
		}
		public static function DBMoney($str = 0)
		{
			$str = str_replace(",","",$str);
			return $str;
		}
		public static function ucwords_tr($gelen)
		{
		  $sonuc='';
		  $kelimeler=explode(" ", $gelen);

		  foreach ($kelimeler as $kelime_duz){

			$kelime_uzunluk=strlen($kelime_duz);
			$ilk_karakter=mb_substr($kelime_duz,0,1,'UTF-8');

			if($ilk_karakter=='Ç' or $ilk_karakter=='ç'){
			  $ilk_karakter='Ç';
			}elseif ($ilk_karakter=='Ğ' or $ilk_karakter=='ğ') {
			  $ilk_karakter='Ğ';
			}elseif($ilk_karakter=='I' or $ilk_karakter=='ı'){
			  $ilk_karakter='I';
			}elseif ($ilk_karakter=='İ' or $ilk_karakter=='i'){
			  $ilk_karakter='İ';
			}elseif ($ilk_karakter=='Ö' or $ilk_karakter=='ö'){
			  $ilk_karakter='Ö';
			}elseif ($ilk_karakter=='Ş' or $ilk_karakter=='ş'){
			  $ilk_karakter='Ş';
			}elseif ($ilk_karakter=='Ü' or $ilk_karakter=='ü'){
			  $ilk_karakter='Ü';
			}else{
			  $ilk_karakter=strtoupper($ilk_karakter);
			}

			$digerleri=mb_substr($kelime_duz,1,$kelime_uzunluk,'UTF-8');
			$sonuc.=$ilk_karakter.Library::kucuk_yap($digerleri).' ';

		  }

		  $son=trim(str_replace('  ', ' ', $sonuc));
		  return $son;

		}
		public static function kucuk_yap($gelen){

		  $gelen=str_replace('Ç', 'ç', $gelen);
		  $gelen=str_replace('Ğ', 'ğ', $gelen);
		  $gelen=str_replace('I', 'ı', $gelen);
		  $gelen=str_replace('İ', 'i', $gelen);
		  $gelen=str_replace('Ö', 'ö', $gelen);
		  $gelen=str_replace('Ş', 'ş', $gelen);
		  $gelen=str_replace('Ü', 'ü', $gelen);
		  $gelen=mb_strtolower($gelen, "UTF-8");

		  return $gelen;
		}
		function Seo($url)
		{
			$url = trim($url);
			$find = array('<b>', '</b>');
			$url = str_replace ($find, '', $url);
			$url = preg_replace('/<(\/{0,1})img(.*?)(\/{0,1})\>/', 'image', $url);
			$find = array(' ', '&amp;amp;amp;quot;', '&amp;amp;amp;amp;', '&amp;amp;amp;', '\r\n', '\n', '/', '\\', '+', '<', '>');
			$url = str_replace ($find, '-', $url);
			$find = array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ë', 'Ê');
			$url = str_replace ($find, 'e', $url);
			$find = array('í', 'ý', 'ì', 'î', 'ï', 'I', 'Ý', 'Í', 'Ì', 'Î', 'Ï','İ','ı');
			$url = str_replace ($find, 'i', $url);
			$find = array('ó', 'ö', 'Ö', 'ò', 'ô', 'Ó', 'Ò', 'Ô');
			$url = str_replace ($find, 'o', $url);
			$find = array('á', 'ä', 'â', 'à', 'â', 'Ä', 'Â', 'Á', 'À', 'Â');
			$url = str_replace ($find, 'a', $url);
			$find = array('ú', 'ü', 'Ü', 'ù', 'û', 'Ú', 'Ù', 'Û');
			$url = str_replace ($find, 'u', $url);
			$find = array('ç', 'Ç');
			$url = str_replace ($find, 'c', $url);
			$find = array('þ', 'Þ','ş','Ş');
			$url = str_replace ($find, 's', $url);
			$find = array('ð', 'Ð','ğ','Ğ');
			$url = str_replace ($find, 'g', $url);
			$find = array('/[^A-Za-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
			$repl = array('', '-', '');
			$url = preg_replace ($find, $repl, $url);
			$url = str_replace ('--', '-', $url);
			$url = strtolower($url);
			return $url;
		}
		/*public function SendMail($SendEmail, $Subject, $Content)
		{
			// Mail Gönderecek Olan Kodlar;

			$this->Subject 		= $Subject;
			$this->Content 		= $Content;
			$this->SendEmail	= $SendEmail;

			$mail = new PHPMailer();

			$System 	= Library::Settings(1);
			$WebMail 	= Library::WebMail(1);

			$mail->AddAddress($this->SendEmail, $System->Title);
			$mail->Port = 465;
			$mail->Subject     = $this->Subject;
			$mail->Body        = $this->Content;
			$mail->SetLanguage("tr", "phpmailer/language");
			$mail->CharSet  ="utf-8";
			$mail->Encoding="base64";
			$mail->SMTPSecure = "tls";
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->Host     = $WebMail->Host;
			$mail->Username = $WebMail->UserName;
			$mail->Password = $WebMail->Password;
			$mail->IsHTML(true);
			$mail->From     = $System->Email;
			$mail->FromName = $System->Title;
			if(!@$mail->Send())
			{
				return false;
			}
			else
			{
				return true;
			}
		}*/
		public function SendMail($SendEmail, $Subject, $Content)
		{
			// Mail Gönderecek Olan Kodlar;

			$this->Subject 		= $Subject;
			$this->Content 		= $Content;
			$this->SendEmail	= $SendEmail;

			$mail = new PHPMailer();

			$System 	= Library::Settings(1);
			$WebMail 	= Library::WebMail(1);

			//include '../../EmailTemplate/header.php';
			//include '../../EmailTemplate/footer.php';

			$EmailTemplateHeaderOpen = file_get_contents($this->DEFAULT_DIR.'EmailTemplate/header.php');
			$EmailTemplateFooterOpen = file_get_contents($this->DEFAULT_DIR.'EmailTemplate/footer.php');

			// Header
			$EmailTemplateHeaderOpen = str_replace("##Title##", $System->Title, $EmailTemplateHeaderOpen);
			$EmailTemplateHeaderOpen = str_replace("##SystemURL##", $this->URL, $EmailTemplateHeaderOpen);

			// Footer

			$EmailTemplateFooterOpen = str_replace("##SystemURL##", $System->EmailURL, $EmailTemplateFooterOpen);
			$EmailTemplateFooterOpen = str_replace("##Instagram##", $System->Instagram, $EmailTemplateFooterOpen);
			$EmailTemplateFooterOpen = str_replace("##YouTube##", $System->YouTube, $EmailTemplateFooterOpen);
			$EmailTemplateFooterOpen = str_replace("##Rss##", $System->Rss, $EmailTemplateFooterOpen);
			$EmailTemplateFooterOpen = str_replace("##Twitter##", $System->Twitter, $EmailTemplateFooterOpen);
			$EmailTemplateFooterOpen = str_replace("##Facebook##", $System->Facebook, $EmailTemplateFooterOpen);

			$EmailTemplateFooterOpen = str_replace("##Footer##", $System->Footer, $EmailTemplateFooterOpen);


			$Content = $EmailTemplateHeaderOpen." ". $this->Content .$EmailTemplateFooterOpen;



			$mail->AddAddress($this->SendEmail, $System->Title);
			$mail->Port = 465;
			$mail->Subject     = $this->Subject;
			$mail->Body        = $Content;
			$mail->SetLanguage("tr", "phpmailer/language");
			$mail->CharSet  ="utf-8";
			$mail->Encoding="base64";
			$mail->SMTPSecure = "tls";
			$mail->IsSMTP();
			$mail->SMTPAuth = true;
			$mail->Host     = $WebMail->Host;
			$mail->Username = $WebMail->UserName;
			$mail->Password = $WebMail->Password;
			$mail->IsHTML(true);
			$mail->From     = $System->Email;
			$mail->FromName = $System->Title;
			if(!@$mail->Send())
			{
				return false;
			}
			else
			{
				return true;
			}

		}
	}
?>
