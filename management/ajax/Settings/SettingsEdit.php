<?php 
	include '../../Controller.php';
	
	include '../../'.Defined::PATH_CLASS.'Settings.php';
	
	$Settings = new Settings();
	
	$ID = strip_tags(intval($_POST['ID']));
	
	$Settings->Title 		=	$_POST['Title'];
	$Settings->Description 	=	$_POST['Description'];
	$Settings->Keywords 	=	$_POST['Keywords'];
	$Settings->Facebook 	=	$_POST['Facebook'];
	$Settings->Twitter 		=	$_POST['Twitter'];
	$Settings->Youtube 		=	$_POST['Youtube'];
	$Settings->GooglePlus 	=	$_POST['GooglePlus'];
	$Settings->Instagram 	=	$_POST['Instagram'];
	$Settings->Linkedin 	=	$_POST['Linkedin'];
	$Settings->Email 		=	$_POST['Email'];
	$Settings->Years 		=	$_POST['Years'];
	$Settings->WebSite 		=	$_POST['WebSite'];
	/*$Settings->URL 			=	$_POST['URL'];
	$Settings->DemoURL 		=	$_POST['DemoURL'];
	$Settings->EmailURL 	=	$_POST['EmailURL'];
	$Settings->ManagementURL=	$_POST['ManagementURL'];*/
	$Settings->Author 		=	$_POST['Author'];
	$Settings->Footer 		=	$_POST['Footer'];
	
	
	$Settings->SettingsEdit($ID);
	
	print $Settings->OutPutMessage;
?>