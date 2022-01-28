<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/Content.php';
	
	$ID = intval($_GET['ID']);
	
	$Content = new Content();
	
	$Content->ContentDelete($ID);
	
	print $Content->OutPutMessage;
	
	header("refresh:0, url=".$_SERVER['HTTP_REFERER']);
	
?>
