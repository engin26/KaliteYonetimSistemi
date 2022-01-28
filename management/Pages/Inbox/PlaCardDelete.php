<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/PlaCard.php';
	
	$ID = strip_tags(intval($_GET['ID']));
	
	$PlaCard = new PlaCard();
	
	$PlaCard->PlaCardDelete($ID);
	
	print $PlaCard->OutPutMessage;
	
	header("refresh:0, url=".$_SERVER['HTTP_REFERER']);
	
?>
