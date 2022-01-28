<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'News.php';
		
	$News = new News();
	
	$ID = strip_tags(intval($_GET['ID']));
	
	$News->NewsCategoriesID = "1";
	$News->Header 			= $_POST['Header'];
	$News->SeoName 			= Library::Seo($_POST['Header']);
	$News->ShortContent		= $_POST['ShortContent'];
	$News->Link				= $_POST['Link'];
	$News->Content			= $_POST['Content'];
	$News->Cuff				= $_POST['Cuff'];
	$News->Images			= $_POST['Images'];
	$News->TimeSort			= $_POST['TimeSort'];
		
	$News->NewsEdit($ID);
	
	print $News->OutPutMessage;
	
	header("refresh:0, url=".$_SERVER['HTTP_REFERER']);
?>
