<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/MainMenu.php';
	
	$MainMenu	= new MainMenu();
	$DB 		= new DB();
	
	$ID = intval($_GET['ID']);
	$CatID = intval($_GET['CatID']);

	$lineMainMenuList = $MainMenu->MainMenuList($CatID, $ID);
	
	$CategoriesIDListAll = $MainMenu->GetReverseCategoriesListAll($ID);
	
	/* CategoriesID'den Yola Çıkarak Tüm Üst Kategorinin ID'lerini Barındırır. */

	/* Kategori Tespit Et ve Link Oluştur. Başladı */
	$resultCat = $DB->connect->query("SELECT ID, Name FROM MainMenu WHERE CatID = '".$CatID."' AND ID IN(".$CategoriesIDListAll.")");
	
	while($lineCat = $resultCat->fetch(PDO::FETCH_OBJ))
	{
		
		$Link .= "<li><a href='Profile.php?func=MainMenu&CatID=".$CatID."&ID=".$lineCat->ID."'>".$lineCat->Name."</a></li>";
	}

?>
<div>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo Defined::PROFILE ?>">Anasayfa</a>
        </li>
        <li>
            <a href="<?php echo Defined::PROFILE ?>?func=MainMenu&CatID=<?php echo $CatID; ?>">Menüler</a>
        </li>
		
            <?php print $Link; ?>
        
    </ul>
</div>
	<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well" data-original-title="">
                <h2><i class="glyphicon glyphicon-edit"></i> Menü Ekle</h2>

                <div class="box-icon">
                    <a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form role="form" method="POST" action="<?php echo Defined::PROFILE ?>?func=MainMenu&File=MainMenuAdd&CatID=<?php echo $CatID; ?>&ID=<?php echo $ID; ?>">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Menü Adı</label>
                        <input type="text" class="form-control" name="Name" placeholder="Menü Adını Giriniz">
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">URL</label>
                        <input type="text" class="form-control" name="URL" placeholder="URL Giriniz">
                    </div>
					<div class="form-group">
                        <label for="exampleInputEmail1">Sıra No</label>
                        <input type="text" class="form-control" name="siraNo" placeholder="Sıra No Giriniz">
                    </div>
					<div class="form-group">
						<div class="control-group">
							<label class="control-label" for="selectError">Durumu</label>
								<div class="controls">
									<select id="Status" name="Status" data-rel="chosen">
										<option value="1">Göster</option>
										<option value="0">Gizle</option>
									</select>
								</div>
						</div>
					</div>
					<button type="submit" name="MainMenuAdd" class="btn btn-primary">Gönder</button>
                </form>

            </div>
    </div>
    <!--/span-->

</div><!--/row-->
	<?php include 'MainMenuList.php' ?>