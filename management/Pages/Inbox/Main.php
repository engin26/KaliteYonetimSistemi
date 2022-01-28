<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/Inbox.php';
	
	$Inbox = new Inbox();
		
	$lineInboxList = $Inbox->InboxList();
	
	
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
				<a href="<?php echo Defined::PROFILE ?>?func=PlaCard">Gelen Mesajlar</a>
			</li>
		</ul>
	</div>
	
	<?php include 'InboxList.php' ?>
	