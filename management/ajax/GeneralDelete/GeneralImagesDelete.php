<?php 
	include '../../Controller.php';
	
	//include '../../'.Defined::PATH_CLASS.'Settings.php';
	
	$ID = strip_tags(intval($_POST['ID']));

	$DB = new DB();

	$result = $DB->connect->prepare("UPDATE PhotosAlbumsGallery SET ISDELETED = '1' WHERE ID = :ID");
	$result->execute(array(":ID"	=>	$ID));
	
	if(!$result)
	{
		print ViewReports::Error("Hata Oluştu.!!!");
	}
?>