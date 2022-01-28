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

		$("#datepicker_TimeSort").datepicker({
                    dayNames:[ "pazar", "pazartesi", "salı", "çarşamba", "perşembe", "cuma", "cumartesi" ], //günlerin adı
                    dayNamesMin: [ "pa", "pzt", "sa", "çar", "per", "cum", "cmt" ],//kısaltmalar      
                    monthNamesShort: [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ],//ay seçim alanın düzenledik
                    nextText: "ileri",//ileri butonun türkçeleştirdik
                    prevText: "geri",//buda geri butonu için    minDate: new Date(1910,0,1),
                    changeMonth: true,//ayı elle seçmeyi aktif eder
                    changeYear: true,//yılı elee seçime izin verir
                    
                    yearRange: '<?php print date("Y")-100; ?>:<?php print date("Y"); ?>',
                    
                    showAnim: "fade",//takvim açılım animasyonu alta tüm animasyon isimleri yazdım 
                    /*fold-blind-bounce-clip-drop-explode-fade-highlight-puff-pulsate-scale-shake-slide-size-transfer*/
                });


		});

		
	</script>
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo Defined::PROFILE ?>">Anasayfa</a>
			</li>
			<li>
				<a href="<?php echo Defined::PROFILE ?>?func=News">Duyurular</a>
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
					<h2><i class="glyphicon glyphicon-edit"></i> Duyuru Düzenle</h2>

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
							<label for="">Eklenme Tarihi</label>
							<input type="text" class="form-control" id="datepicker_TimeSort" name="TimeSort" value="<?php echo strftime("%m/%d/%Y", $lineNewsDetails->TimeSort); ?>" placeholder="Tarih Seçiniz Giriniz">
						</div>
						<div class="row">
							<div  class="form-group col-lg-10 col-xs-10"><!-- col-lg-offset-right-1 col-md-offset-right-1 col-sm-offset-right-1 col-xs-offset-right-2 -->
								<label for="">Link</label>
								<input type="text" class="form-control" name="Link" value="<?php echo $lineNewsDetails->Link ?>" placeholder="Link Giriniz">
							</div>
						</div>
						<div class="form-group">
							<label for="">İçerik</label>
							<textarea  class="form-control ckeditor" name="Content" id="Content" placeholder="İçerik Giriniz"><?php echo $lineNewsDetails->Content ?></textarea>
						</div>
						<!--<div class="row">
							<div class="form-group col-lg-3">
								<div class="control-group">
									<label class="control-label" for="selectError">Manşette Gösterilsin mi?</label>
									<div class="controls">
										<select class="form-control" id="Cuff" name="Cuff" data-rel="chosen">
											<option value="0" <?php if($lineNewsDetails->Cuff == 0){ echo "selected='selected'";} ?> >Hayır</option>
											<option value="1" <?php if($lineNewsDetails->Cuff == 1){ echo "selected='selected'";} ?> >Evet</option>
										</select>
									</div>
								</div>
							</div>
						</div>-->
						<!--<div class="form-group">
							<img src="../Uploads/News/Big/<?php echo $lineNewsDetails->Images; ?>" width="200" height="150" />
						</div>
						<div class="form-group">
							<label for="">Resim</label>
							<input type="file" class="form-control" name="Images">
						</div>-->

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
	