<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/Gallery.php';
	
	$ID 					= 	intval(strip_tags($_GET['ID']));
	$GalleryMainMenuID 		= 	intval(strip_tags($_GET['GalleryMainMenuID']));
	$GalleryCategoriesID 	= 	intval(strip_tags($_GET['GalleryCategoriesID']));

	$Gallery = new Gallery();

	// Kapak Resim Yapmak İçin Kullanılır
	if(isset($GalleryCategoriesID) && $_GET['Cover'] == 1)
	{
		$Gallery->GalleryCover($GalleryCategoriesID, $ID);
		
	}

	$Gallery->GalleryMainMenuID 	= $GalleryMainMenuID;
	$Gallery->GalleryCategoriesID 	= $GalleryCategoriesID;

	// Kategoriye Ait Galerileri Listeler
	$lineGalleryMainMenuList = $Gallery->GalleryMainMenuList();

	//
	$lineGalleryCategoriesList = $Gallery->GalleryCategoriesList();

	$lineGalleryList = $Gallery->GalleryList();
	
	$lineResolution = $Gallery->Resolution();
?>
	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#GalleryForm").validationEngine();
		});
	</script>
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo Defined::PROFILE ?>">Anasayfa</a>
			</li>
			<li>
				<a href="<?php echo Defined::PROFILE ?>?func=Gallery">Galeri</a>
			</li>
		</ul>
	</div>
	<div>
		<div class="well well-sm">
		<?php 
			foreach ($lineGalleryCategoriesList as $key => $line) 
			{
		?>
				<a <?php $line->ID == $Gallery->GalleryCategoriesID ? print 'class="btn btn-danger"' : print 'class="btn btn-primary"'; ?> href="<?php Defined::PROFILE ?>?func=Gallery&GalleryMainMenuID=<?php echo $line->GalleryMainMenuID ?>&GalleryCategoriesID=<?php echo $line->ID; ?>"><?php echo $line->Name; ?></a>
				
		<?php	
			}
		?>
		</div>
	</div>
	<div class="row">
		<div class="box col-md-12">
		<?php 
			if($Gallery->GalleryCategoriesID != 0)
			{
		?>
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> Galeri Ekle</h2>

					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				
				<div class="box-content">
					<form role="form" id="GalleryForm" name="GalleryForm" method="POST" enctype="multipart/form-data" action="<?php echo Defined::PROFILE ?>?func=Gallery&File=GalleryAdd&GalleryMainMenuID=<?php echo $Gallery->GalleryMainMenuID; ?>&GalleryCategoriesID=<?php echo $Gallery->GalleryCategoriesID; ?>">
						
						<div class="form-group "><!-- col-lg-offset-right-1 col-md-offset-right-1 col-sm-offset-right-1 col-xs-offset-right-2 -->
							<label for="">Başlık</label>
							<input type="text" class="form-control  validate[required]" name="Name" placeholder="Başlık Giriniz">
						</div>
						
						<div class="form-group "><!-- col-lg-offset-right-1 col-md-offset-right-1 col-sm-offset-right-1 col-xs-offset-right-2 -->
							<label for="">URL</label>
							<input type="text" class="form-control" name="Link" placeholder="Adres Giriniz" >
						</div>
						<div class="form-group">
							<label for="">Resim</label>
							<input type="file" class="form-control" name="Images[]" multiple>
						</div>
						<div class="input-block-level">
						<button type="submit" name="GalleryAdd" class="btn btn-primary">Gönder</button>
						</div>
					</form>

				</div>
				
			</div>
			
		<!--/span-->

		</div><!--/row-->
	</div>
	<div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-picture"></i> Fotoğraf Galerisi</h2>

                    <div class="box-icon">
 
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i
                                class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i
                                class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
                <div class="box-content">
                <?php 
                	isset($Gallery->OutPutMessageCover) ? print $Gallery->OutPutMessageCover : print ""; 
                ?>
                    <br>
                    <ul class="thumbnails gallery">
                    	<?php 
	                    	if(count($lineGalleryList) != 0)
	                    	{
	                    		foreach ($lineGalleryList as $line) 
	                    		{
                    	?>

                    			<li id="image-<?php print $line->ID; ?>" class="thumbnail">
                    				<?php
                    					if($line->Cover != 1)
                    					{
                    				?>
                    				<span style="position:absolute; top:-4px; left:-6px; z-index:999"><a  href="javascript:void(0);" onClick="GalleryDelete('image-<?php print $line->ID; ?>', 'Gallery', '<?php print $line->ID; ?>');"  class="gallery-delete btn"><img src="img/close-blue.png" style="width:16px; height=16px " /></a></span>
                    				<?php 
                    					}
                    				?>
                    				<a class="fancybox" href="<?php echo $lineResolution[0]->Path.$line->Images; ?>" data-fancybox-group="gallery" title="<?php echo $line->Name ?>" href="<?php echo $lineResolution[0]->Path.$line->Images; ?>">
                    				<img  src="<?php echo $lineResolution[0]->Path.$line->Images; ?>" alt="<?php echo $line->Name ?>"></a>
                    				<div style="width:100%; text-align:center">
                    							<a href="<?php Defined::PROFILE ?>?func=Gallery&File=GalleryEditForm&GalleryMainMenuID=<?php echo $GalleryMainMenuID; ?>&GalleryCategoriesID=<?php echo $Gallery->GalleryCategoriesID ?>&ID=<?php echo $line->ID; ?>&Cover=1" style="font-size:11px;">Düzenle</a>
                    						</div>
                    				<?php
                    					if($line->Cover == 1)
                    					{
                    				?>
                    						<!--<div style="width:100%; text-align:center">Kapak Resim</div>-->
                    				<?php 
                    					}
                    					else
                    					{
                    				?>
                    						<!--<div style="width:100%; text-align:center">
                    							<a href="<?php Defined::PROFILE ?>?func=Gallery&GalleryMainMenuID=<?php echo $GalleryMainMenuID; ?>&GalleryCategoriesID=<?php echo $Gallery->GalleryCategoriesID ?>&ID=<?php echo $line->ID; ?>&Cover=1" style="font-size:11px;">Kapak Resim Yap</a>
                    						</div>-->
                    				<?php		
                    					}
                    				?>
                    			</li>
                    	<?php
	                    		}
	                    	}
	                    	else
	                    	{
                    	?>
                    		<div class="alert alert-warning">Resim Bulunamadı.!!!</div>
                    	<?php	
                    		}
                    	?>
                    </ul>
                </div>
            </div>
        </div>
        <!--/span-->

    </div><!--/row-->

    <?php 
			}
			else
			{
				?>
				<div class="alert alert-warning">Lütfen Seçim Yapınız</div>
				<?php		
			}
	?>
	
	