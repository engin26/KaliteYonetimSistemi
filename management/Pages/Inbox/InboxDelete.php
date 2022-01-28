<!-- content starts -->
<?php 
	include Defined::PATH_CLASS.'/Inbox.php';
	
	$ID = strip_tags(intval($_GET['ID']));
	
	$Inbox = new Inbox();
	
	$Inbox->InboxDelete($ID);
	
	print $Inbox->OutPutMessage;
	
	header("refresh:0, url=Profile.php?func=Inbox");
	
?>
