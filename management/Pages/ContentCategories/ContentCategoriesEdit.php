<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'ContentCategories.php';
		
	$ContentCategories = new ContentCategories();
	
	$ID = strip_tags(intval($_GET['ID']));
	
	$ContentCategories->Name = $_POST['Name'];
	
	$ContentCategories->ContentCategoriesEdit($ID);
	
	print $ContentCategories->OutPutMessage;
	
	header("Location:".Defined::PROFILE.'?func=ContentCategories');
	
?>
