	<div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> İçerikler</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>

                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable responsive">
                        <thead>
							<tr>
								<th>Kategorisi</th>
                                <th>Sayfa Adı</th>
								<th>Sıra No</th>
								<th>Durumu</th>
								<th>İşlemler</th>
							</tr>
                        </thead>
                        <tbody>
						<?php
						if(count($lineContentList) != 0)
						{
							foreach($lineContentList as $lineContentList)
							{
						?>
                        <tr>
                            <td><?php print $Content->CategoriesWhere($CatID); ?></td>
                            <td><?php echo $lineContentList->Name; ?></td>
                            <td><?php echo $lineContentList->siraNo; ?></td>
                            <td><?php $lineContentList->Status == 1 ? print "Aktif" : print "Pasif"; ?></td>

                            <td class="center">
								<a class="btn btn-danger" onClick="DeleteConfirm('Profile.php?func=Content&File=ContentDelete&ID=<?php print $lineContentList->ID; ?>')" href="javascript:void(0);">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Sil
                                </a>
                                <a class="btn btn-info" href="<?php echo Defined::PROFILE ?>?func=Content&File=ContentEditForm&ID=<?php echo $lineContentList->ID; ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Düzenle
                                </a>

								<!--<a class="btn btn-success" href="<?php echo Defined::PROFILE ?>?func=Content&CatID=<?php echo $CatID; ?>&ID=<?php echo $lineContentList->ID; ?>">
                                    <i class="glyphicon glyphicon-check icon-white"></i>
                                    Alt İçerik Ekle
                                </a>-->
                            </td>
                        </tr>
						<?php
							}
						}
						else
						{
						?>
							 <tr><td colspan="7">Kayıt Bulunamadı.!!!</td></tr>
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
