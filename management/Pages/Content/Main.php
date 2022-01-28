<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/Content.php';
	
	$Content	= new Content();
	$DB 		= new DB();
	
	$ID = intval($_GET['ID']);
	$CatID = intval($_GET['CatID']);

	$lineContentList = $Content->ContentList($CatID, $ID);
	
	$CategoriesIDListAll = $Content->GetReverseCategoriesListAll($ID);
	
	/* CategoriesID'den Yola Çıkarak Tüm Üst Kategorinin ID'lerini Barındırır. */

	/* Kategori Tespit Et ve Link Oluştur. Başladı */
	$resultCat = $DB->connect->query("SELECT ID, Name FROM content WHERE CatID = '".$CatID."' AND ID IN(".$CategoriesIDListAll.")");
	
	while($lineCat = $resultCat->fetch(PDO::FETCH_OBJ))
	{
		
		$Link .= "<li><a href='Profile.php?func=Content&CatID=".$CatID."&ID=".$lineCat->ID."'>".$lineCat->Name."</a></li>";
	}
	
?>
<script>
		/* Form Control */
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#ContentForm").validationEngine();
		});

		
	</script>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo Defined::PROFILE ?>">Panel Anasayfa</a>
        </li>
        <li>
            <a href="<?php echo Defined::PROFILE ?>?func=Content&CatID=<?php echo $CatID; ?>">Ana Dizin</a>
        </li>
		
            /*<?php print $Link; ?>
        
    </ul>
</div>
	<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> İçerik Ekle</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form role="form" id="ContentForm" method="POST" enctype="multipart/form-data" action="<?php echo Defined::PROFILE ?>?func=Content&File=ContentAdd&CatID=<?php echo $CatID; ?>&ID=<?php echo $ID; ?>">
                    <div class="row">
						<div  class="form-group col-lg-10 col-xs-10">
                       		<label for="exampleInputEmail1">Sayfa Adı</label>
                       		<input type="text" class="form-control validate[required]" name="Name" placeholder="Sayfa Adını Giriniz">
                    	</div>
                    </div>
                    
					<div class="form-group">
						<label for="">İçerik</label>
						<textarea  class="form-control ckeditor" name="Content" id="Content"  placeholder="İçerik Giriniz"></textarea>
					</div>
					<div class="form-group">
						<div class="control-group">
							<label class="control-label" for="selectError">Durumu</label>
								<div class="controls">
									<select id="Status" name="Status" data-rel="chosen" style="width:100px;">
										<option value="1">Göster</option>
										<option value="0">Gizle</option>
									</select>
								</div>
						</div>
					</div>
					<button type="submit" name="ContentAdd" class="btn btn-primary">Gönder</button>
                </form>

            </div>
    </div>
    <!--/span-->

</div><!--/row-->
	<?php include 'ContentList.php' ?>