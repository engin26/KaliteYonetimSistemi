	<?php
		include 'header.php';
	?>
	<?php
		$lineNewsList = NewsList(1);
		$sayi=0;
		foreach($lineNewsList as $key => $value) {
		$sayi++;   }
		if ($sayi > 0) {
		include 'modalpanel.php'; }
	?>

	<?php
		include 'ust_menu.php';
	?>
 </div>
	<div class="row" >

      <div class="col-lg-3 col-md-12 col-12">
        <form method="GET" action="arama.php">

			  <div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<input style="margin-top:10px;  padding-right:0px; text-align:center;" type="text" class="form-control" placeholder="Kalite Dökümanlarında Arama" name="q">

				<input style="width:100%; margin-top:10px; background:#333; color:#c0c0c0; font-family: 'Roboto', sans-serif;border-bottom: 3px solid #FD5025;" type="submit" class="form-control "  name="b1" value="Arama">
			  </div>

        </form>

	  </div>



      <div class="col-lg-6 col-md-12 col-12">



       <div class="flexslider" style="margin-top:10px;" >
        <ul class="slides flex-viewport1">
          <?php
            $lineGalleryList = GalleryList(5);
            foreach ($lineGalleryList as $key => $value) {
          ?>
              <li>
                <img src="Uploads/Gallery/Big/<?php print $value->Images; ?>" />
              </li>

          <?php
            }
          ?>

        </ul>
      </div>

        <div class="row">
          <?php
            $lineGalleryList = GalleryList(4);

            $i=1;

            foreach ($lineGalleryList as $key => $value) {
               if($i > 6) $col="4"; else $col = "4";

          ?>

		<?php if ($i==20) { ;?>

            <div class="col-lg-<?php print $col ?> col-md-4 col-12  cerceve text-center"><img src="Uploads/Gallery/Big/<?php print $value->Images; ?>" class="img-fluid "  data-toggle="modal" data-target="#kidneyModelPanel">
            </div>

        <?php }else { ?>

               <div class="col-lg-<?php print $col ?> col-md-4 col-12 cerceve text-center"><a href="<?php print $value->Link; ?>" target="_blank"><img src="Uploads/Gallery/Big/<?php print $value->Images; ?>" class="img-fluid "></a>
            </div>

        <?php } ?>


          <?php
              $i++;
            }

          ?>


        </div>

      </div>
			<div  class="col-lg-3 col-md-12 col-12" >
				<marquee direction="up" onmouseover="this.stop();" onmouseout="this.start();" height="375px" style="margin-top:10px;" >
					<?php
						//$lineNewsList = NewsList(1);
						$resultMaxRevisionDate = $db->prepare("SELECT ID FROM files WHERE RevisionDate = (SELECT RevisionDate FROM files WHERE  ISDELETED=0 ORDER BY RevisionDate DESC LIMIT 0,1) ");
						$resultMaxRevisionDate->execute();
						$lineMaxRevisionDate = $resultMaxRevisionDate->fetchAll(PDO::FETCH_ASSOC);
						foreach($lineMaxRevisionDate as $redID){
							$RedIDArray[] = $redID['ID'];
						}
						print '<div style="display:inline; color:red; font-weight: bold;  ">Duyurular</div>';
						$resultNews=$db->query("SELECT * FROM files WHERE ID IN(".implode(', ', $RedIDArray).")");
						$lineNewsList = $resultNews->fetchAll(PDO::FETCH_OBJ);

						foreach($lineNewsList as $key => $value) {
					?>

							<li >  Dosya Adı <b><?php print $value->Name; ?></b> olan <?php print date("d.m.Y", strtotime($value->RevisionDate)) ?> tarihinde güncellenmiştir.</li>
					<?php
						}
					?>
				</marquee>
			</div>

	  </div>
			<!-- Modal Başvuru Page
<div class="modal fade" id="atModelPanel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 style="color:red" align="center">
<b>BAŞVURU İÇİN YAPILMASI GEREKENLER</b></h4>
</div>
			<div class="carousel-item active">
		<img class="img-fluid" src="images/analiz_yol_haritasi.jpg" >
		</div>
<div class="modal-body" style="text-align:center; color:blue ;">
			<b>BAŞVURU FORMU ALMAK İSTER MİSİNİZ ?</b>
</div>
		<center>
<div class= align="center">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır</button>
<button type="button" class="btn btn-primary" onclick="location='Harici-Basvuru.pdf'" target="_blank">Evet</button>
<br></br>
</div>
		</center>
</div>
</div>
</div>

<div class="modal fade" id="kidneyModelPanel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h4 style="color:red" align="center">
<b>BAŞVURU İÇİN YAPILMASI GEREKENLER</b></h4>
</div>
<div class="carousel-item active">
<img class="img-fluid" src="images/bobrek_yol_haritasi.jpg" >
</div>
<div class="modal-body" style="text-align:center; color:blue ;">
<b>BAŞVURU FORMU ALMAK İSTER MİSİNİZ ?</b>
</div>
<center>
<div class= align="center">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır</button>
<button type="button" class="btn btn-primary" onclick="location='Bobrektasi-Analizi-Basvuru-Formu.pdf'" target="_blank">Evet</button>
<br></br>
</div>
</center>
</div>
</div>
</div>
-->

    </div>
  </div>
<?php
  include 'footer.php';
?>
