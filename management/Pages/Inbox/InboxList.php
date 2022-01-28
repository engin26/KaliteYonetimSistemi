	<div class="row">
        <div class="box col-md-12">
            <div class="box-inner">
                <div class="box-header well" data-original-title="">
                    <h2><i class="glyphicon glyphicon-user"></i> Gelen Kutusu</h2>

                    <div class="box-icon">
                        <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
                        <a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
                    </div>
                </div>
				
                <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable <?php count($lineInboxList) != 0 ? print 'datatable' : print ''; ?> responsive">
                        <thead>
							<tr>
								<th>Adı Soyadı</th>
								<th>E-mail Adresi</th>
								<th>Telefon Numarası</th>
								<th>Gönderilme Tarihi</th>
								<th>İşlemler</th>
							</tr>
                        </thead>
                        <tbody>
						<?php
						if(count($lineInboxList) != 0)
						{
							$i=1;
							foreach($lineInboxList as $lineInboxList)
							{
                                $Time = strftime("%d-%m-%Y %X");
						?> 
                        <tr>
                            <td width="200"><?php echo $lineInboxList->Name; ?></td>
                            <td width="200"><?php echo $lineInboxList->Email; ?></td>
                            <td width="200"><?php echo $lineInboxList->PhoneNo; ?></td>
                            <td width="200"><?php echo $Time; ?></td>
                            
                            <td class="center">
                                <a class="btn btn-danger" onClick="DeleteConfirm('Profile.php?func=Inbox&File=InboxDelete&ID=<?php print $lineInboxList->ID; ?>')" href="javascript:void(0);">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Sil
                                </a>
                                <a class="btn btn-warning" href="Profile.php?func=Inbox&File=InboxDetails&ID=<?php echo $lineInboxList->ID ?>">
                                    <i class="glyphicon glyphicon-edit icon-edit"></i>
                                     Detaylar
                                </a>
                            </td>
                        </tr>
						<?php
								$i++;
							}
						}
						else
						{
						?>
							 <tr><td colspan="5">Kayıt Bulunamadı.!!!</td></tr>
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
	