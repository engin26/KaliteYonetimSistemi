<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/MainMenuCategories.php';
	
	$ID = intval($_GET['ID']);
	
	$MainMenuCategories = new MainMenuCategories();
	
	$MainMenuCategories->MainMenuCategoriesDelete($ID);
	
	print $MainMenuCategories->OutPutMessage;
	
	header("Location:".Defined::PROFILE.'?func=MainMenuCategories');
	exit;
?>
