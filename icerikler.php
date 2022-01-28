<?php 
	include 'config.php';
	include 'header.php';
	
	$q_lowercase = strip_tags(strto('lower', $_GET['q']));
	$q_upper = strip_tags(strto('upper', $_GET['q']));
	$q_first = strip_tags(ucwords_tr($_GET['q']));

	$cat_id = intval($_GET['cat_id']);
	$id 	= intval($_GET['id']);
	
	$result = $db->prepare("SELECT * FROM content WHERE CatID = :cat_id AND ID = :id");
	$result->bindParam(":cat_id", $cat_id, PDO::PARAM_INT);
	$result->bindParam(":id", $id, PDO::PARAM_INT);
	if(!$result->execute())
	{
		exit();
	}
	if($result->rowCount() < 1) header("location:index.php");
	
	$line = $result->fetch(PDO::FETCH_OBJ);

	//$line->Content = htmlentities($line->Content);
	
	$line->Content = str_replace("<sup>", "<tt>", $line->Content);
	$line->Content = str_replace("</sup>", "</tt>", $line->Content);

	$line->Content = str_replace("<sub>", "<ttp>", $line->Content);
	$line->Content = str_replace("</sub>", "</ttp>", $line->Content);

	$line->Content = str_replace($q, "<span style='color:yellow; background-color:black'> ".$q."</span>", $line->Content);
	$line->Content = str_replace($q_upper, "<span style='color:yellow; background-color:black'> ".$q_lowercase."</span>", $line->Content);
	$line->Content = str_replace($q_first, "<span style='color:yellow; background-color:black'> ".$q_lowercase."</span>", $line->Content);
	
	$line->Content = str_replace("<tt>", "<sup>", $line->Content);
	$line->Content = str_replace("</tt>", "</sup>", $line->Content);

	$line->Content = str_replace("<ttp>", "<sub>", $line->Content);
	$line->Content = str_replace("</ttp>", "</sub>", $line->Content);

	$line->Content = htmlspecialchars_decode($line->Content);
	

?>
	
	<div class="col-lg-9 col-md-9 col-xs-12" id="Content" style="margin-top:60px;" >
		<?php print $line->Content; ?>
	</div>
<?php
	include 'footer.php';
?>

<script type="text/javascript">
	$(document).ready(function(){
		//$('#Content').html($('#Content').html().replace('<?php print $q_lowercase ?>',"<span style='color:yellow; background-color:black'><?php print $q_lowercase ?></span>"));
	});
</script>