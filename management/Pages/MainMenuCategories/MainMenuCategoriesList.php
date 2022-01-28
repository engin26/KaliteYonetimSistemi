	<div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> Sayfa Kategorisi</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
				
                <div class="box-content">
                    <table class="table table-striped table-bordered responsive">
                        <thead>
							<tr>
								<th>Adı</th>
								<th>İşlemler</th>
							</tr>
                        </thead>
                        <tbody>
						<?php
						if(count($lineMainMenuCategoriesList) != 0)
						{
							foreach($lineMainMenuCategoriesList as $lineMainMenuCategoriesList)
							{
						?> 
                        <tr>
                            <td><?php echo $lineMainMenuCategoriesList->Name; ?></td>
                            
                            <td class="center">
								<a class="btn btn-danger" onClick="DeleteConfirm('Profile.php?func=MainMenuCategories&File=MainMenuCategoriesDelete&ID=<?php print $lineMainMenuCategoriesList->ID; ?>')" href="javascript:void(0);">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Sil
                                </a>
                                <a class="btn btn-info" href="<?php echo Defined::PROFILE ?>?func=MainMenuCategories&File=MainMenuCategoriesEditForm&ID=<?php echo $lineMainMenuCategoriesList->ID; ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Düzenle
                                </a>
                                
								 <a class="btn btn-success" href="<?php echo Defined::PROFILE ?>?func=MainMenu&CatID=<?php echo $lineMainMenuCategoriesList->ID; ?>">
                                    <i class="glyphicon glyphicon-check icon-white"></i>
                                    Menü Ekle
                                </a>
                            </td>
                        </tr>
						<?php 
							}
						}
						else
						{
						?>
							 <tr><td colspan="2">Kayıt Bulunamadı.!!!</td></tr>
						<?php
						}
						?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--/span-->

    </div><!--/row-->