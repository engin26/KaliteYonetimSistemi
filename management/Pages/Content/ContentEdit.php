<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'Content.php';
		
	$Content = new Content();
	
	$ID = strip_tags(intval($_GET['ID']));
	
	$Content->Name 		= $_POST['Name'];
	$Content->Header 	= $_POST['Header'];
	$Content->Content 	= $_POST['Content'];
	$Content->Images 	= $_POST['Images'];
	$Content->URL 		= $_POST['URL'];
	$Content->siraNo	= $_POST['siraNo'];
	$Content->Status 	= $_POST['Status'];
	$Content->ContentEdit($ID);
	
	print $Content->OutPutMessage;
	
	header("refresh:1, url=".$_SERVER['HTTP_REFERER']);
	
?>
