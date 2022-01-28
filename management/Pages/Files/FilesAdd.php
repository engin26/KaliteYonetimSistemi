<!-- content starts -->
<?php
	include Defined::PATH_CLASS.'Files.php';
	$Files = new Files();
	$Library = new Library();

	$Files->FilesCategoriesID 					= $_POST['FilesCategoriesID'];
	$Files->Name 					  						= $_POST['Name'];
	$Files->Files 											= $_POST['Files'];
	$Files->FileNo 			  							= $_POST['FileNo'];
	$Files->PublishDate									= $Library->DbDate($_POST['PublishDate']);
	$Files->RevisionNo			  					= $_POST['RevisionNo'];
	$Files->RevisionDate								= $Library->DbDate($_POST['RevisionDate']);
	$Files->Status											= $_POST['Status'];
	$Files->OrderNo											= $_POST['OrderNo'];


	$Files->FilesAdd();

	print $Files->OutPutMessage;

	header("refresh:1; url=".$_SERVER['HTTP_REFERER']);
?>
