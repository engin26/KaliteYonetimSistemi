<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/FlatPages.php';
	
	$ID = strip_tags(intval($_GET['ID']));
	
	$FlatPages = new FlatPages();
	
	$FlatPages->FlatPagesDelete($ID);
	
	print $FlatPages->OutPutMessage;
	
	header("refresh:0, url=".$_SERVER['HTTP_REFERER']);
	
?>
