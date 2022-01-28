<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/Content.php';
	
	$Content = new Content();
	
	$ID = strip_tags(intval($_GET['ID']));
	$CatID = strip_tags(intval($_GET['CatID']));

	$lineContentDetails = $Content->ContentFindID($ID);
	
?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo Defined::PROFILE ?>">Anasayfa</a>
        </li>
        <li>
            <a href="<?php echo Defined::PROFILE ?>?func=Content&CatID=<?php echo $lineContentDetails->CatID; ?>">İçerikler</a>
        </li>
    </ul>
</div>
	<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> İçerik Düzenle</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
           
			<div class="box-content">
                <form role="form" method="POST" enctype="multipart/form-data" action="<?php echo Defined::PROFILE ?>?func=Content&File=ContentEdit&ID=<?php echo $ID; ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Sayfa Adı</label>
                        <input type="text" class="form-control" name="Name" value="<?php echo $lineContentDetails->Name ?>" placeholder="Sayfa Adını Giriniz">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Başlık</label>
                        <input type="text" class="form-control" name="Header" value="<?php echo $lineContentDetails->Header ?>" placeholder="İçerik Adını Giriniz">
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">URL</label>
                        <input type="text" class="form-control" name="URL" value="<?php echo $lineContentDetails->URL ?>" placeholder="URL Giriniz">
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Sıra No</label>
                        <input type="text" class="form-control" name="siraNo" value="<?php echo $lineContentDetails->siraNo ?>" placeholder="Sıra No Giriniz">
                    </div>
					
                    <div class="form-group">
                        <label for="">Resim</label>
                        <input type="file" class="form-control" name="Images">
                    </div>
                    <div class="form-group">
                        <label for="">İçerik</label>
                        <textarea  class="form-control ckeditor" name="Content" id="Content"  placeholder="İçerik Giriniz"><?php echo $lineContentDetails->Content; ?></textarea>
                    </div>
                 
                    
                    <div class="form-group">
						<div class="control-group">
							<label class="control-label" for="selectError">Durumu</label>
								<div class="controls">
									<select id="Status" name="Status" data-rel="chosen">
										<option <?php $lineContentDetails->Status == 1 ? print 'selected' : print ""; ?> value="1">Göster</option>
										<option <?php $lineContentDetails->Status == 0 ? print 'selected' : print ""; ?> value="0">Gizle</option>
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
	<?php //include 'PagesCategoriesList.php' ?>