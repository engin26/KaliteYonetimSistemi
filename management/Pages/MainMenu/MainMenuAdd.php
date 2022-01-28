<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'MainMenu.php';
		
	$MainMenu = new MainMenu();
	
	$ID = strip_tags(intval($_GET['ID']));
	$CatID = strip_tags(intval($_GET['CatID']));

	$MainMenu->CatID 	= $CatID;
	$MainMenu->SupID 	= $ID;
	$MainMenu->Name 	= $_POST['Name'];
	$MainMenu->URL 		= $_POST['URL'];
	$MainMenu->siraNo	= $_POST['siraNo'];
	$MainMenu->Status 	= $_POST['Status'];
	
	$MainMenu->MainMenuAdd();
	
	print $MainMenu->OutPutMessage;
	
	header("Location:".$_SERVER['HTTP_REFERER']);
	exit();
	
?>
