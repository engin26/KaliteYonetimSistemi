<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'MainMenuCategories.php';
		
	$MainMenuCategories = new MainMenuCategories();
	
	$MainMenuCategories->Name = $_POST['Name'];
	
	$MainMenuCategories->MainMenuCategoriesAdd();
	
	print $MainMenuCategories->OutPutMessage;
	
	header("Location:".Defined::PROFILE.'?func=MainMenuCategories');
	exit;
	
?>
