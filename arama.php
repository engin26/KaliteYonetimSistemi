<?php
	include 'config.php';
	include 'header.php';
	include 'ust_menu.php';

	$arama = strip_tags($_GET['q']);
	$result = $db->prepare("SELECT * FROM files WHERE (Name LIKE :search OR FileNo LIKE :search)");
	$result->bindValue(":search", '%'.$arama.'%', PDO::PARAM_STR);
	if(!$result->execute())
	{
		exit();
	}
	if($result->rowCount() < 1) header("location:index.php"  );

	$lineFiles = $result->fetchAll(PDO::FETCH_OBJ);
?>

	<div class="col-lg-12 col-md-12 col-xs-12"style="margin-top:60px">
		<h2 align="center" style="color:red">Arama Sonuçları</h2>
		<br></br>
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	    <?php
	      if(count($lineFiles) > 0){
	    ?>
	        <table class="table" align="center">
						<thead class="thead-dark">
	          <tr>
							<th>Bağlı Olduğu Döküman</th>
	            <th>Dokuman No</th>
	            <th>Dokuman Adı</th>
	            <th>Yayın Tarihi</th>
	            <th>Revizyon No/Tarihi</th></tr>
							</thead>
	          <?php foreach($lineFiles as $files){ ?>
	            <tr <?php echo (in_array($files->ID, $RedIDArray) ? "bgcolor='red'":"") ?>>
									<td><?php echo filesCategoriesFind($files->FilesCategoriesID)->Name  ?></td>
	                <td><?php echo $files->FileNo ?></td>
	                <td><a href="Uploads/Files/<?php print $files->Files ?>"><?php echo $files->Name ?></a></td>
	                <td><?php echo trDate($files->PublishDate) ?></td>
	                <td><?php echo RevNoAdd($files->RevisionNo).' / '.trdate($files->RevisionDate) ?></td>
	            </tr>
	          <?php } ?>
	        </table>
	    <?php
	      }
	    ?>
	  </div>
	</div>
<?php
	include 'footer.php';
?>
