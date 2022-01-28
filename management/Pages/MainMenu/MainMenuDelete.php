<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/MainMenu.php';
	
	$ID = intval($_GET['ID']);
	
	$MainMenu = new MainMenu();
	
	$MainMenu->MainMenuDelete($ID);
	
	print $MainMenu->OutPutMessage;
	
	header("Location:".$_SERVER['HTTP_REFERER']);
	exit();
	
?>
