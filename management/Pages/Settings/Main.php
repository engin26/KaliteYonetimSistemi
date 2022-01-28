<!-- content starts -->
<?php 
	
	$Settings = new Settings();
	
	$ID = strip_tags(intval($_GET['ID']));
	
	$lineSettingsList = $Settings->SettingsList($ID);
	
?>
	
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo Defined::PROFILE ?>">Anasayfa</a>
			</li>
			<li>
				<a href="<?php echo Defined::PROFILE ?>?func=FlatPages">Site Ayarları</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i> Site Ayarları</h2>

					<div class="box-icon">
						<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
						<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
						<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
					</div>
				</div>
				<div class="box-content">
					<form role="form" id="SettingsForm" name="SettingsForm" method="POST" onSubmit="return false;">
						<div class="form-group "><!-- col-lg-offset-right-1 col-md-offset-right-1 col-sm-offset-right-1 col-xs-offset-right-2 -->
							<label for="">Site Başlığı</label>
							<input type="text" class="form-control validate[required]" name="Title" id="Title" value="<?php echo $lineSettingsList->Title ?>" placeholder="Site Başlığı Giriniz">
						</div>
						<div class="form-group "><!-- col-lg-offset-right-1 col-md-offset-right-1 col-sm-offset-right-1 col-xs-offset-right-2 -->
							<label for="">Description</label>
							<input type="text" class="form-control validate[required]" name="Description" value="<?php echo $lineSettingsList->Description ?>" placeholder="Description Giriniz">
						</div>
						<div class="form-group">
							<label for="">Keywords</label>
							<input type="text" class="form-control validate[required]" name="Keywords" value="<?php echo $lineSettingsList->Keywords ?>" placeholder="Keywords Giriniz">
						</div>
						<div class="form-group"></div>
						<div class="form-group"></div>
						<div class="form-group"></div>
						<div class="form-group"></div>
<div class="form-group">
		    <label for="">Web Site Adresi</label>
							<input type="text" class="form-control" name="WebSite" value="<?php echo $lineSettingsList->WebSite ?>" placeholder="Web Site Adresinizi Giriniz">
						</div>
						
						<!--<div class="form-group">
							<label for="">URL</label>
							<input type="text" class="form-control" name="URL" value="<?php echo $lineSettingsList->URL ?>" placeholder="URL Adresinizi Giriniz">
						</div>
						<div class="form-group">
							<label for="">Demo URL</label>
							<input type="text" class="form-control" name="DemoURL" value="<?php echo $lineSettingsList->DemoURL ?>" placeholder="Demo URL Adresinizi Giriniz">
						</div>
						<div class="form-group">
							<label for="">Email URL</label>
							<input type="text" class="form-control" name="EmailURL" value="<?php echo $lineSettingsList->EmailURL ?>" placeholder="Email URL Adresinizi Giriniz">
						</div>
						<div class="form-group">
							<label for="">Panel URL</label>
							<input type="text" class="form-control" name="ManagementURL" value="<?php echo $lineSettingsList->ManagementURL ?>" placeholder="Panel URL Adresinizi Giriniz">
						</div>-->
						<div class="form-group">
							<label for="">Yapımcı</label>
							<input type="text" class="form-control" name="Author" value="Engin Dalmış" placeholder="Link Giriniz">
						</div>
						<div class="form-group">
							<label for="">Footer</label>
							<input type="text" class="form-control" name="Footer" value="<?php echo $lineSettingsList->Footer ?>" placeholder="Footer Giriniz">
						</div>
                        
						<div class="input-block-level">
						<button type="submit" name="SettingsAdd" class="btn btn-primary">Gönder</button>
                        
						</div>
					</form>
					<div class="box-content" id="SettingsResult"></div>
				</div>
			</div>
		<!--/span-->

		</div><!--/row-->
	</div>
	<script>
		$(document).ready(function(){
			$("#SettingsForm").validationEngine('attach', {
				onValidationComplete: function(form, status){
					if(status == true)
					{
						SettingsEdit(<?php echo $ID ?>);
					}
					else
					{
						
					}
				}  
			})
		});
	</script>
