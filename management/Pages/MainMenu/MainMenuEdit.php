<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'MainMenu.php';
		
	$MainMenu = new MainMenu();
	
	$ID = strip_tags(intval($_GET['ID']));
	
	$MainMenu->Name 	= $_POST['Name'];
	$MainMenu->URL 		= $_POST['URL'];
	$MainMenu->siraNo	= $_POST['siraNo'];
	$MainMenu->Status 	= $_POST['Status'];
	$MainMenu->MainMenuEdit($ID);
	
	print $MainMenu->OutPutMessage;
	
	header("Location:".$_SERVER['HTTP_REFERER']);
	exit();
	
?>
