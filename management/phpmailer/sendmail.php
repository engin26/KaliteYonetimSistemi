<?php require_once("class.phpmailer.php");
$sistememail="ramazan@pikselbilisim.com";
$mail = new PHPMailer();

$mail->AddAddress($sistememail,"EAFP");
$mail->Port = 465;
$mail->Subject     = "EAFP 2013 ABSTRACT";
$mail->Body        = '<html><head><title>Abstract for EAFP2013</title><body>
			Sent on&nbsp;'.
			date("d-m-Y").'at'.	date("H:i:s").
			   '<br><br><font size="3"><a href="http://www.eafp2013.com/word1.php?id='.$ozetno.'">
			   Click to open Abstarct as word file.</font></a><br><br>
			   The abstract will open as a word file with a short "Abstract Reviewer Report" below it. <br>
			   Save it onto your computer.<br>
			   Go through the abstract and indicate your corrections if any.<br>
			   Fill out the "Abstract Reviewer Report".<br>
			   Submit the document to sibel@pharmacy.ankara.edu.tr<br><br><br>
			   Thank you for your time.
			   <br><br><br><br>  
			   
			   
			   Note: Mail not click on the link on your screen "in the HTML View," select'.
			   '</body></html>';
			   
$mail->SMTPSecure = "tls";
$mail->IsSMTP();
$mail->Host     = "";
$mail->SMTPAuth = true;
$mail->Username = "";
$mail->Password = "";
$mail->IsHTML(true);
//$mail->From     = $_POST['Email'];
$mail->From     = "";
//$mail->FromName = $_POST['Isim'];
$mail->FromName = "EAFP";
//$mail->Send();


if(!@$mail->Send()) { // EMail'i g�nderir. 
echo "Error: " . $mail->ErrorInfo; // Hatay� g�ster.
 } else {
echo $sistememail."&nbsp; adresine mail g�nderildi.";
 }

?>