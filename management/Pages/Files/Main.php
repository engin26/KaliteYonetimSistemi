<!-- content starts -->
<?php
	include Defined::PATH_CLASS.'/Files.php';

	$Files = new Files();
	$Library = new Library();

	$lineFilesCategoriesList = $Files->FileCategoriesList();
	$lineFilesList = $Files->FilesList(0);


?>




<script>
				$(function() {
					 // sss
						$("#PublishDate").datepicker({
									dayNames:[ "pazar", "pazartesi", "salı", "çarşamba", "perşembe", "cuma", "cumartesi" ],//günlerin adı
									dayNamesMin: [ "pa", "pzt", "sa", "çar", "per", "cum", "cmt" ],//kısaltmalar
									monthNamesShort: [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ],//ay seçim alanın düzenledik
									nextText: "ileri",//ileri butonun türkçeleştirdik
									prevText: "geri",//buda geri butonu için    minDate: new Date(1910,0,1),
									changeMonth: true,//ayı elle seçmeyi aktif eder
									changeYear: true,//yılı elee seçime izin verir
									dateFormat: 'dd.mm.yy' ,
									yearRange: '<?php print date("Y")-100; ?>:<?php print date("Y"); ?>',

									showAnim: "fade",//takvim açılım animasyonu alta tüm animasyon isimleri yazdım
									/*fold-blind-bounce-clip-drop-explode-fade-highlight-puff-pulsate-scale-shake-slide-size-transfer*/
							});

			$("#RevisionDate").datepicker({
									dayNames:[ "pazar", "pazartesi", "salı", "çarşamba", "perşembe", "cuma", "cumartesi" ],//günlerin adı
									dayNamesMin: [ "pa", "pzt", "sa", "çar", "per", "cum", "cmt" ],//kısaltmalar
									monthNamesShort: [ "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık" ],//ay seçim alanın düzenledik
									nextText: "ileri",//ileri butonun türkçeleştirdik
									prevText: "geri",//buda geri butonu için    minDate: new Date(1910,0,1),
									changeMonth: true,//ayı elle seçmeyi aktif eder
									changeYear: true,//yılı elee seçime izin verir
									dateFormat: 'dd.mm.yy' ,
									yearRange: '<?php print date("Y")-100; ?>:<?php print date("Y"); ?>',

									showAnim: "fade",//takvim açılım animasyonu alta tüm animasyon isimleri yazdım
									/*fold-blind-bounce-clip-drop-explode-fade-highlight-puff-pulsate-scale-shake-slide-size-transfer*/
							});

							$('.btn-number').click(function(e){
						    e.preventDefault();

						    fieldName = $(this).attr('data-field');
						    type      = $(this).attr('data-type');
						    var input = $("input[name='"+fieldName+"']");
						    var currentVal = parseInt(input.val());
						    if (!isNaN(currentVal)) {
						        if(type == 'minus') {

						            if(currentVal > input.attr('min')) {
						                input.val(currentVal - 1).change();
						            }
						            if(parseInt(input.val()) == input.attr('min')) {
						                $(this).attr('disabled', true);
						            }

						        } else if(type == 'plus') {

						            if(currentVal < input.attr('max')) {
						                input.val(currentVal + 1).change();
						            }
						            if(parseInt(input.val()) == input.attr('max')) {
						                $(this).attr('disabled', true);
						            }

						        }
						    } else {
						        input.val(0);
						    }
						});
						$('.input-number').focusin(function(){
						   $(this).data('oldValue', $(this).val());
						});
						$('.input-number').change(function() {

						    minValue =  parseInt($(this).attr('min'));
						    maxValue =  parseInt($(this).attr('max'));
						    valueCurrent = parseInt($(this).val());

						    name = $(this).attr('name');
						    if(valueCurrent >= minValue) {
						        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
						    } else {
						        alert('Sorry, the minimum value was reached');
						        $(this).val($(this).data('oldValue'));
						    }
						    if(valueCurrent <= maxValue) {
						        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
						    } else {
						        alert('Sorry, the maximum value was reached');
						        $(this).val($(this).data('oldValue'));
						    }


							});
							$(".input-number").keydown(function (e) {
							        // Allow: backspace, delete, tab, escape, enter and .
							        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
							             // Allow: Ctrl+A
							            (e.keyCode == 65 && e.ctrlKey === true) ||
							             // Allow: home, end, left, right
							            (e.keyCode >= 35 && e.keyCode <= 39)) {
							                 // let it happen, don't do anything
							                 return;
							        }
							        // Ensure that it is a number and stop the keypress
							        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
							            e.preventDefault();
							        }
							    });
											});
	</script>

	<div>
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo Defined::PROFILE ?>">Anasayfa</a>
			</li>
			<li>
				<a href="<?php echo Defined::PROFILE ?>?func=Files">Dosya Yönetimi</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> Dosya Ekle</h2>

					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form role="form" id="FilesForm" name="FilesForm" method="POST" enctype="multipart/form-data" action="<?php echo Defined::PROFILE ?>?func=Files&File=FilesAdd">
						<div class="row">
							<div class="form-group col-lg-3">
								<div class="control-group">
									<label class="control-label" for="selectError">Dosya Kategorisi</label>
									<div class="controls">
										<select class="form-control validate[required]" id="FilesCategoriesID" name="FilesCategoriesID" >
											<option value="">Seçiniz</option>
											<?php
												foreach($lineFilesCategoriesList as $list){
											?>
											<option value="<?php print $list->ID; ?>"><?php print $list->Name; ?></option>
										<?php } ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group "><!-- col-lg-offset-right-1 col-md-offset-right-1 col-sm-offset-right-1 col-xs-offset-right-2 -->
							<label for="">Döküman Adı</label>
							<input type="text" class="form-control validate[required]" name="Name" id="Name" placeholder="Döküman Adı Giriniz">
						</div>
						<div class="form-group "><!-- col-lg-offset-right-1 col-md-offset-right-1 col-sm-offset-right-1 col-xs-offset-right-2 -->
							<label for="">Döküman No</label>
							<input type="text" class="form-control validate[required]" name="FileNo" placeholder="Döküman Giriniz">
						</div>
						<label >Revizyon Numarası</label>
						<div class="input-group" >
							<div class="col-sm-2">
		          <span class="input-group-btn">
		              <button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="RevisionNo">
		                  <span class="glyphicon glyphicon-minus"></span>
		              </button>
		          </span>
							</div>
								<div class="col-sm-3">
		          <input type="text" name="RevisionNo" id="RevisionNo" class="form-control input-number" value="0" min="00" max="100"  >
						</div>
							<div class="col-sm-2">
		          <span class="input-group-btn">
		              <button type="button" class="btn btn-default btn-number" data-type="plus" data-field="RevisionNo" >
		                  <span class="glyphicon glyphicon-plus"></span>
		              </button>
		          </span>
								</div>

						</div>
						<div class="form-group">
							<label for="">Yayın Tarihi</label>
							<input type="text" class="form-control" id="PublishDate" name="PublishDate" value="<?php echo date("d.m.Y"); ?>" placeholder="Tarih Seçiniz Giriniz">
						</div>
						<div class="form-group">
							<label for="">Revizyon Tarihi</label>
							<input type="text" class="form-control" id="RevisionDate" name="RevisionDate" value="<?php echo date("d.m.Y"); ?>" placeholder="Tarih Seçiniz Giriniz">
						</div>
						<div class="row">
							<div class="form-group col-lg-3">
								<div class="control-group">
									<label class="control-label" for="selectError">Durumu</label>
									<div class="controls">
										<select class="form-control" id="Status" name="Status" data-rel="chosen">
											<option value="0">Pasif</option>
											<option value="1">Aktif</option>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="">Dosya Ekle</label>
							<input type="file" class="form-control validate[required]" name="Files">
						</div>

						<div class="input-block-level">
						<button type="submit" name="FilesAdd" class="btn btn-primary">Gönder</button>
						</div>
					</form>

				</div>
			</div>
		<!--/span-->

		</div><!--/row-->
	</div>
	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#FilesForm").validationEngine();
		});

		$(document).ready(function(){
			$(".mce-statusbar mce-container mce-panel mce-last mce-stack-layout-item").addClass('validate[required]');
		});
	</script>
	<?php include 'FilesList.php' ?>
