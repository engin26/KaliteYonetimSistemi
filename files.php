<?php

  include 'header.php';
?>
<?php

  $lineNewsList = NewsList(1);
  $sayi=0;
  foreach($lineNewsList as $key => $value) {
  $sayi++;   }
  if ($sayi > 0) {
    include 'modalpanel.php';
  }

  $filesCategoriesID = intval($_GET['filesCategoriesID']);

  $resultFiles = $db->prepare("SELECT * FROM files WHERE filesCategoriesID = ? AND ISDELETED=0 ORDER BY FileNo ASC");
  $resultFiles->execute(array($filesCategoriesID));
  $lineFiles = $resultFiles->fetchAll(PDO::FETCH_OBJ);

  $resultMaxRevisionDate = $db->prepare("SELECT ID FROM files WHERE RevisionDate = (SELECT RevisionDate FROM files WHERE filesCategoriesID = :filesCategoriesID AND ISDELETED=0 ORDER BY RevisionDate DESC LIMIT 0,1)");
  $resultMaxRevisionDate->bindParam(":filesCategoriesID", $filesCategoriesID, PDO::PARAM_INT);
  $resultMaxRevisionDate->execute();
  $lineMaxRevisionDate = $resultMaxRevisionDate->fetchAll(PDO::FETCH_ASSOC);
  foreach($lineMaxRevisionDate as $redID){
    $RedIDArray[] = $redID['ID'];
  }

?>

<?php
  include 'ust_menu.php';
?>
</div>
<div class="row" >
<div class="container">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php
    $sıraNo=1;
      if(count($lineFiles) > 0){

    ?>
    <br>
  </br>
    <div class="container">
      <div class="row justify-content-md-center">
        <h1 style="color:red"><?php echo filesCategoriesFind($lineFiles[0]->FilesCategoriesID)->Name  ?></h1>
      </div>
    </div>
    <br>
  </br>


        <table class="table ">
          <thead class="thead-dark">
          <tr>
            <th>Sıra No</th>
            <th>Dokuman No</th>
            <th>Dokuman Adı</th>
            <th>Yayın Tarihi</th>
            <th>Revizyon No/Tarihi</th></tr>
             </thead>
          <?php foreach($lineFiles as $files){ ?>
            <tr onmouseout="this.bgColor='';" onmouseover="this.bgColor='#FFFFD9';" bgcolor=""<?php echo (in_array($files->ID, $RedIDArray) ? 'style="color:red;"':"") ?>>
                <td><?php echo $sıraNo++ ?></td>
                <td><?php echo $files->FileNo ?></td>
                <td><a <?php echo (in_array($files->ID, $RedIDArray) ? 'style="color:red;"':"") ?> href="Uploads/Files/<?php print $files->Files ?>"><?php echo $files->Name ?></a></td>
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
</div>
<?php
include 'footer.php';
?>
