	<div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i>Eklenen Dosya Listesi</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>

                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        <thead>
							<tr>

								<th>Dosya Kategorisi</th>
								<th>Döküman No</th>
								<th>Döküman Adı</th>
								<th>Yayın Tarihi</th>
								<th>Revizyon Numarası</th>
								<th>Revizyon Tarihi</th>
								<th>Durumu</th>
								<th>İşlemler</th>
							</tr>
                        </thead>
                        <tbody>
						<?php
						if(count($lineFilesList) != 0)
						{
							foreach($lineFilesList as $lineFilesList)
							{
								if ($lineFilesList->Status==0) {
									$Status='Pasif';
								} elseif ($lineFilesList->Status==1) {
									$Status='Aktif';
								}
						?>
                        <tr>
                            
														<td><?php echo ($lineFilesList->FilesCategoriesID==0 ? "Kategorisi Yokk":$Files->FileCategoriesFindID($lineFilesList->FilesCategoriesID)->Name); ?></td>
														<td><?php echo $lineFilesList->FileNo; ?></td>
                            <td><?php echo $lineFilesList->Name; ?></td>
                            <td><?php echo $Library->trDate($lineFilesList->PublishDate); ?></td>
														<td><?php echo $lineFilesList->RevisionNo; ?></td>
														<td><?php echo $Library->trDate($lineFilesList->RevisionDate); ?></td>
														<td><?php echo $Status; ?></td>


                            <td class="center">
								<a class="btn btn-danger" onClick="DeleteConfirm('Profile.php?func=Files&File=FilesDelete&ID=<?php print $lineFilesList->ID; ?>')" href="javascript:void(0);">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Sil
                                </a>
                                <a class="btn btn-info" href="<?php echo Defined::PROFILE ?>?func=Files&File=FilesEditForm&ID=<?php echo $lineFilesList->ID; ?>">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Düzenle
                                </a>
								<!--<a class="btn btn-success" href="<?php echo Defined::PROFILE ?>?func=PagesMenu&File=PagesMenuDetails&ID=<?php echo $linePagesMenuList->ID; ?>">
                                    <i class="glyphicon glyphicon-check icon-white"></i>
                                    Detaylar
                                </a>-->
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
