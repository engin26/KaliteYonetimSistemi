	<div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> Haberler</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
				
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
                        <thead>
							<tr>
								<th>Başlık</th>
								<th>Kısa Açıklama</th>
								<th>Resim</th>
								<th>İşlemler</th>
							</tr>
                        </thead>
                        <tbody>
						<?php
						if(count($lineNewsList) != 0)
						{
							foreach($lineNewsList as $lineNewsList)
							{
						?> 
                        <tr>
                            <td width="250"><?php echo $lineNewsList->Header; ?></td>
                            <td width="250"><?php echo strip_tags(substr($lineNewsList->ShortContent, 0, 120)); ?></td>
                            <td><img src="../Uploads/News/Big/<?php echo $lineNewsList->Images; ?>" width="100" height="100"></td>
                            
                            <td class="center">
								<a class="btn btn-danger" onClick="DeleteConfirm('Profile.php?func=News&File=NewsDelete&ID=<?php print $lineNewsList->ID; ?>')" href="javascript:void(0);">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Sil
                                </a>
                                <a class="btn btn-info" href="<?php echo Defined::PROFILE ?>?func=News&File=NewsEditForm&ID=<?php echo $lineNewsList->ID; ?>">
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
	