<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'Gallery.php';
		
	$Gallery = new Gallery();
	
	$GalleryCategoriesID = intval(strip_tags($_GET['GalleryCategoriesID']));
	$ID = intval(strip_tags($_GET['ID']));

	$Gallery->ID					= $ID;
	$Gallery->GalleryCategoriesID	= $GalleryCategoriesID;
	$Gallery->Name 					= $_POST['Name'];
	$Gallery->Link 					= $_POST['Link'];
	$Gallery->Images				= $_FILES['Images'];
	
	$Gallery->GalleryEdit();
	
	print $Gallery->OutPutMessage;
	
	//header("refresh:2; url=".$_SERVER['HTTP_REFERER']);	
?>
