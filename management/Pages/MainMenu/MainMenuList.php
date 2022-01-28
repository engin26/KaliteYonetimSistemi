	<div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> Menüler</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
				
                <div class="box-content">
                    <table class="table table-striped table-bordered responsive">
                        <thead>
							<tr>
								<th>Kategorisi</th>
								<th>Menü Adı</th>
								<th>URL</th>
								<th>Sıra No</th>
								<th>Durumu</th>
								<th>İşlemler</th>
							</tr>
                        </thead>
                        <tbody>
						<?php
						if(count($lineMainMenuList) != 0)
						{
							foreach($lineMainMenuList as $lineMainMenuList)
							{
						?> 
                        <tr>
                            <td><?php print $MainMenu->CategoriesWhere($ID); ?></td>
                            <td><?php echo $lineMainMenuList->Name; ?></td>
                            <td><?php echo $lineMainMenuList->URL; ?></td>
                            <td><?php echo $lineMainMenuList->siraNo; ?></td>
                            <td><?php $lineMainMenuList->Status == 1 ? print "Aktif" : print "Pasif"; ?></td>
                            
                            <td class="center">
								<a class="btn btn-danger" onClick="DeleteConfirm('Profile.php?func=MainMenu&File=MainMenuDelete&ID=<?php print $lineMainMenuList->ID; ?>')" href="javascript:void(0);">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Sil
                                </a>
                                <a class="btn btn-info" href="<?php echo Defined::PROFILE ?>?func=MainMenu&File=MainMenuEditForm&ID=<?php echo $lineMainMenuList->ID; ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Düzenle
                                </a>
                                
								 <a class="btn btn-success" href="<?php echo Defined::PROFILE ?>?func=MainMenu&CatID=<?php echo $CatID; ?>&ID=<?php echo $lineMainMenuList->ID; ?>">
                                    <i class="glyphicon glyphicon-check icon-white"></i>
                                    Alt Menü Ekle
                                </a>
                            </td>
                        </tr>
						<?php 
							}
						}
						else
						{
						?>
							 <tr><td colspan="6">Kayıt Bulunamadı.!!!</td></tr>
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