<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'Content.php';
		
	$Content = new Content();
	
	$ID = strip_tags(intval($_GET['ID']));
	$CatID = strip_tags(intval($_GET['CatID']));

	$Content->CatID 	= $CatID;
	$Content->SupID 	= $ID;
	$Content->Name 		= $_POST['Name'];
	$Content->Header 	= $_POST['Header'];
	$Content->URL 		= $_POST['URL'];
	$Content->Images	= $_POST['Images'];
	$Content->siraNo	= $_POST['siraNo'];
	$Content->Content	= $_POST['Content'];
	$Content->Status 	= $_POST['Status'];
	
	$Content->ContentAdd();
	
	print $Content->OutPutMessage;
	
	header("refresh:0, url=".$_SERVER['HTTP_REFERER']);
	
?>
