<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'ContentCategories.php';
		
	$ContentCategories = new ContentCategories();
	
	$ContentCategories->Name = $_POST['Name'];
	
	$ContentCategories->ContentCategoriesAdd();
	
	print $ContentCategories->OutPutMessage;
	
	header("Location:".Defined::PROFILE.'?func=ContentCategories');
	
?>
