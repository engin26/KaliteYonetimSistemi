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
						if(count($lineContentCategoriesList) != 0)
						{
							foreach($lineContentCategoriesList as $lineContentCategoriesList)
							{
						?> 
                        <tr>
                            <td><?php echo $lineContentCategoriesList->Name; ?></td>
                            
                            <td class="center">
								<a class="btn btn-danger" onClick="DeleteConfirm('Profile.php?func=ContentCategories&File=ContentCategoriesDelete&ID=<?php print $lineContentCategoriesList->ID; ?>')" href="javascript:void(0);">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Sil
                                </a>
                                <a class="btn btn-info" href="<?php echo Defined::PROFILE ?>?func=ContentCategories&File=ContentCategoriesEditForm&ID=<?php echo $lineContentCategoriesList->ID; ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Düzenle
                                </a>
                                
								 <a class="btn btn-success" href="<?php echo Defined::PROFILE ?>?func=Content&CatID=<?php echo $lineContentCategoriesList->ID; ?>">
                                    <i class="glyphicon glyphicon-check icon-white"></i>
                                    İçerik Ekle/Göster
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