<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/FlatPages.php';
	
	$FlatPages = new FlatPages();
	
	$ID = strip_tags(intval($_GET['ID']));
	
	$lineFlatPagesDetails = $FlatPages->FlatPagesFindID($ID);
	
?>
	<script>
		/* Form Control */
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#FlatPagesForm").validationEngine();
		});
	</script>
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo Defined::PROFILE ?>">Anasayfa</a>
			</li>
			<li>
				<a href="<?php echo Defined::PROFILE ?>?func=FlatPages">Sayfalar</a>
			</li>
			<li>
				<a href="javascript:void(0);"><?php echo $lineFlatPagesDetails->Header; ?></a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> Sayfa Ekle</h2>

					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form role="form" id="FlatPagesForm" name="FlatPagesForm" method="POST" enctype="multipart/form-data" action="<?php echo Defined::PROFILE ?>?func=FlatPages&File=FlatPagesEdit&ID=<?php echo $ID; ?>">
						
						<div class="form-group "><!-- col-lg-offset-right-1 col-md-offset-right-1 col-sm-offset-right-1 col-xs-offset-right-2 -->
							<label for="">Sayfa Adı</label>
							<input type="text" class="form-control  validate[required]" name="Name" value="<?php echo $lineFlatPagesDetails->Name ?>" placeholder="Sayfa Adı Giriniz">
						</div>
						<div class="form-group "><!-- col-lg-offset-right-1 col-md-offset-right-1 col-sm-offset-right-1 col-xs-offset-right-2 -->
							<label for="">Başlık</label>
							<input type="text" class="form-control  validate[required]" name="Header" value="<?php echo $lineFlatPagesDetails->Header ?>" placeholder="Başlık Giriniz">
						</div>
						<div class="form-group">
							<label for="">Kısa Açıklama</label>
							<input type="text" class="form-control" name="ShortContent" value="<?php echo $lineFlatPagesDetails->ShortContent ?>" placeholder="Kısa Açıklama Giriniz">
						</div>
						<div class="form-group">
							<label for="">Link</label>
							<input type="text" class="form-control" name="Link" value="<?php echo $lineFlatPagesDetails->Link; ?>" placeholder="Link Giriniz">
						</div>
						<div class="form-group">
							<label for="">İçerik</label>
							<textarea  class="form-control ckeditor" name="Content" id="Content" placeholder="İçerik Giriniz"><?php echo $lineFlatPagesDetails->Content ?></textarea>
						</div>
						
						<div class="form-group">
							<label for="">Description</label>
							<input type="text" class="form-control" name="Description" value="<?php echo $lineFlatPagesDetails->Description ?>" placeholder="Arama Motorları İçin Giriniz">
						</div>
						<div class="form-group">
							<label for="">Keywords</label>
							<input type="text" class="form-control" name="Keywords" value="<?php echo $lineFlatPagesDetails->Keywords ?>" placeholder="Arama Motorları İçin Anahtar Kelime Giriniz">
						</div>
						<div class="input-block-level">
						<button type="submit" name="FlatPagesEdit" class="btn btn-primary">Gönder</button>
						</div>
					</form>

				</div>
			</div>
		<!--/span-->

		</div><!--/row-->
	</div>
	<?php //include 'PagesMenuList.php' ?>
	