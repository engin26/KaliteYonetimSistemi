<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'MainMenuCategories.php';
		
	$MainMenuCategories = new MainMenuCategories();
	
	$ID = strip_tags(intval($_GET['ID']));
	
	$MainMenuCategories->Name = $_POST['Name'];
	
	$MainMenuCategories->MainMenuCategoriesEdit($ID);
	
	print $MainMenuCategories->OutPutMessage;
	
	header("Location:".Defined::PROFILE.'?func=MainMenuCategories');
	exit;
?>
