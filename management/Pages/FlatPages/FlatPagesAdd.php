<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'FlatPages.php';
	$FlatPages = new FlatPages();
		
	$FlatPages->Name 					= $_POST['Name'];
	$FlatPages->Header 					= $_POST['Header'];
	$FlatPages->SeoName 				= Library::Seo($_POST['Header']);
	$FlatPages->ShortContent			= $_POST['ShortContent'];
	$FlatPages->Link					= $_POST['Link'];
	$FlatPages->Content					= $_POST['Content'];
	$FlatPages->Images					= $_POST['Images'];
	$FlatPages->Description				= $_POST['Description'];
	$FlatPages->Keywords				= $_POST['Keywords'];
	
	$FlatPages->FlatPagesAdd();
	
	print $FlatPages->OutPutMessage;
	
	header("refresh:1; url=".$_SERVER['HTTP_REFERER']);	
?>
