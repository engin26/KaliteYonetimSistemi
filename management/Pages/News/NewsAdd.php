<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'News.php';
		
	$News = new News();
		
	$News->NewsCategoriesID 		= $_POST['NewsCategoriesID'];
	$News->Header 					= $_POST['Header'];
	$News->SeoName 					= Library::Seo($_POST['Header']);
	$News->ShortContent				= $_POST['ShortContent'];
	$News->Link						= $_POST['Link'];
	$News->Content					= $_POST['Content'];
	$News->Images					= $_POST['Images'];
	$News->Cuff						= $_POST['Cuff'];
	$News->TimeSort					= $_POST['TimeSort'];
	$News->Description				= $_POST['Description'];
	$News->Keywords					= $_POST['Keywords'];
	
	$News->NewsAdd();
	
	print $News->OutPutMessage;
	
	header("refresh:1; url=".$_SERVER['HTTP_REFERER']);	
?>
