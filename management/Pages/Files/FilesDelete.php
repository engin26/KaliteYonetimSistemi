<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/Files.php';
	
	$ID = strip_tags(intval($_GET['ID']));
	
	$Files = new Files();
	
	$Files->FilesDelete($ID);
	
	print $Files->OutPutMessage;
	
	header("refresh:0, url=".$_SERVER['HTTP_REFERER']);
	
?>
