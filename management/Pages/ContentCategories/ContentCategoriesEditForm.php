<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/ContentCategories.php';
	
	$ContentCategories = new ContentCategories();
	
	$ID = strip_tags(intval($_GET['ID']));
	
	$lineContentCategoriesDetails = $ContentCategories->ContentCategoriesFindID($ID);
	
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo Defined::PROFILE ?>">Anasayfa</a>
        </li>
        <li>
            <a href="javascript:void(0);">İçerik Kategorisi</a>
        </li>
    </ul>
</div>
	<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> İçerik Kategorisi Düzenle</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form role="form" method="POST" action="<?php echo Defined::PROFILE ?>?func=ContentCategories&File=ContentCategoriesEdit&ID=<?php echo $ID ?>">
                    <div class="form-group">
                        <label for="PagesCategoriesName"> Adı</label>
                        <input type="text" class="form-control" name="Name" value="<?php echo $lineContentCategoriesDetails->Name; ?>" placeholder="Adı Giriniz">
                    </div>
					<button type="submit" name="ContentCategoriesEdit" class="btn btn-primary">Gönder</button>
                </form>

            </div>
    </div>
    <!--/span-->

</div><!--/row-->
	<?php //include 'PagesCategoriesList.php' ?>