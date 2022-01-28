<?php 
	include 'config.php';
	include 'header.php';
	
	$ID 	= intval($_GET['ID']);
	
	$result = $db->prepare("SELECT * FROM flatpages WHERE ID = :id");
	$result->bindParam(":id", $ID, PDO::PARAM_INT);
	if(!$result->execute())
	{
		exit();
	}
	if($result->rowCount() < 1) header("location:index.php");
	
	$line = $result->fetch(PDO::FETCH_OBJ);
?>
	
	<div class="col-lg-6 col-md-12 col-12" style="margin-top:60px;">
		<!-- <h1 class="h1_top_bosluk"><?php print $line->Header; ?></h1>-->
		<?php print $line->Content; ?>
	</div>
	<?php 
		include 'sol_menu.php';
	?>
<?php
	include 'footer.php';
?>