<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'FlatPages.php';
		
	$FlatPages = new FlatPages();
	
	$ID = strip_tags(intval($_GET['ID']));
	
	$FlatPages->Name 			= $_POST['Name'];
	$FlatPages->Header 			= $_POST['Header'];
	$FlatPages->SeoName 		= Library::Seo($_POST['Header']);
	$FlatPages->ShortContent	= $_POST['ShortContent'];
	$FlatPages->Link			= $_POST['Link'];
	$FlatPages->Content			= $_POST['Content'];
	$FlatPages->Images			= $_POST['Images'];
	$FlatPages->Description		= $_POST['Description'];
	$FlatPages->Keywords		= $_POST['Keywords'];
	
	$FlatPages->FlatPagesEdit($ID);
	
	print $FlatPages->OutPutMessage;
	
	header("refresh:0, url=".$_SERVER['HTTP_REFERER']);
?>
