<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/News.php';
	
	$News = new News();
	
	$ID = strip_tags(intval($_GET['ID']));
	
	$lineNewsDetails = $News->NewsFindID($ID);
	
?>
	<script>
		/* Form Control */
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#NewsForm").validationEngine();
		});

		$(document).ready(function(){
			$(".mce-statusbar mce-container mce-panel mce-last mce-stack-layout-item").addClass('validate[required]');
		});
	</script>
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo Defined::PROFILE ?>">Anasayfa</a>
			</li>
			<li>
				<a href="<?php echo Defined::PROFILE ?>?func=News">Haberler</a>
			</li>
			<li>
				<a href="javascript:void(0);"><?php echo $lineNewsDetails->Header; ?></a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> Haber Düzenle</h2>

					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form role="form" id="NewsForm" name="NewsForm" method="POST" enctype="multipart/form-data" action="<?php echo Defined::PROFILE ?>?func=News&File=NewsEdit&ID=<?php echo $ID; ?>">
						
						<div class="form-group "><!-- col-lg-offset-right-1 col-md-offset-right-1 col-sm-offset-right-1 col-xs-offset-right-2 -->
							<label for="">Başlık</label>
							<input type="text" class="form-control  validate[required]" name="Header" value="<?php echo $lineNewsDetails->Header ?>" placeholder="Başlık Giriniz">
						</div>
						<div class="form-group">
							<label for="">Kısa Açıklama</label>
							<input type="text" class="form-control" name="ShortContent" value="<?php echo $lineNewsDetails->ShortContent ?>" placeholder="Kısa Açıklama Giriniz">
						</div>
						<div class="form-group">
							<label for="">İçerik</label>
							<textarea  class="form-control ckeditor" name="Content" id="Content" placeholder="İçerik Giriniz"><?php echo $lineNewsDetails->Content ?></textarea>
						</div>
						<div class="form-group">
							<img src="../Uploads/News/Big/<?php echo $lineNewsDetails->Images; ?>" width="200" height="150" />
						</div>
						<div class="form-group">
							<label for="">Resim</label>
							<input type="file" class="form-control" name="Images">
						</div>
						
						<div class="input-block-level">
						<button type="submit" name="NewsEdit" class="btn btn-primary">Gönder</button>
						</div>
					</form>

				</div>
			</div>
		<!--/span-->

		</div><!--/row-->
	</div>
	<?php //include 'PagesMenuList.php' ?>
	