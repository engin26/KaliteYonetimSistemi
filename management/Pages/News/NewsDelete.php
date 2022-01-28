<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/News.php';
	
	$ID = strip_tags(intval($_GET['ID']));
	
	$News = new News();
	
	$News->NewsDelete($ID);
	
	print $News->OutPutMessage;
	
	header("refresh:0, url=".$_SERVER['HTTP_REFERER']);
	
?>
