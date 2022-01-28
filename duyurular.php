<?php 
	include 'config.php';
	include 'header.php';
	
	$ID 	= intval($_GET['ID']);
	
	$result = $db->prepare("SELECT * FROM news WHERE ID = :id order by id desc");
	$result->bindParam(":id", $ID, PDO::PARAM_INT);
	if(!$result->execute())
	{
		exit();
	}
	if($result->rowCount() < 1) header("location:index.php");
	
	$line = $result->fetch(PDO::FETCH_OBJ);
?>
	
	<div class="col-lg-9 col-md-9 col-xs-12">
		<div class="col-lg-9 col-md-9 col-xs-12 topBosluk"></div>
		<h2><?php print $line->ShortContent; ?></h2>
		<?php print $line->Content; ?>
	</div>
<?php
	include 'footer.php';
?>