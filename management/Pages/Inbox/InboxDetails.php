<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/Inbox.php';
	
	$ID = intval($_GET['ID']);

	$Inbox = new Inbox();
		
	$lineInboxList = $Inbox->InboxDetails($ID);
	
	
?>
	<script>
		jQuery(document).ready(function(){
			// binds form submission and fields to the validation engine
			jQuery("#NewsForm").validationEngine();
		});

		$(document).ready(function(){
			$(".mce-statusbar mce-container mce-panel mce-last mce-stack-layout-item").addClass('validate[required]');
		});
	</script>
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="<?php echo Defined::PROFILE ?>">Anasayfa</a>
			</li>
			<li>
				<a href="<?php echo Defined::PROFILE ?>?func=Inbox">Gelen Mesajlar</a>
			</li>
		</ul>
	</div>
	
	  <div class="box-content">
	  	<div class="box-header well" data-original-title="">
	  		<h2><i class="glyphicon glyphicon-edit"></i> Mesaj Detayları</h2>
	  			<div class="box-icon">
					<a href="#" class="btn btn-setting btn-round btn-default"><i class="glyphicon glyphicon-cog"></i></a>
					<a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round btn-default"><i class="glyphicon glyphicon-remove"></i></a>
				</div>
		</div>
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			<tr><th width="100">Adı Soyadı</th><td width="200"><?php echo $lineInboxList->Name; ?></td></tr>
            <tr><th width="100">E-mail</th><td width="200"><?php echo $lineInboxList->Email; ?></td></tr>
            <tr><th width="100">Telefon Numarası</th><td width="200"><?php echo $lineInboxList->PhoneNo; ?></td></tr>
            <tr><th width="100">Mesaj</th><td width="200"><?php echo strip_tags($lineInboxList->Message); ?></td></tr>
            <td class="center" colspan="2">
                                <a class="btn btn-danger" onClick="DeleteConfirm('Profile.php?func=Inbox&File=InboxDelete&ID=<?php print $lineInboxList->ID; ?>')" href="javascript:void(0);">
                                    <i class="glyphicon glyphicon-trash icon-white"></i>
                                    Sil
                                </a>
                                
                            </td>
                        </tr>
						
                        </tbody>
                    </table>
    </div>
	