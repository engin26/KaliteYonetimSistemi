<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/ContentCategories.php';
	
	$ID = intval($_GET['ID']);
	
	$ContentCategories = new ContentCategories();
	
	$ContentCategories->ContentCategoriesDelete($ID);
	
	print $ContentCategories->OutPutMessage;
	
	header("Location:".Defined::PROFILE.'?func=ContentCategories');
	
?>
