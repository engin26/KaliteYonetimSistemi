

<?php		
	if($Grants->GrantsControl($_GET['func']) == 1)/*0 iken title'ı fixlemek için 1 yapıldı*/
	{
		echo ViewReports::ErrorGrants();
	}
	else
	{
        $file = ($_GET['File']);
		echo '<script src="Pages/'.$_GET['func'].'/'.'js/Validate.js"></script>';
		switch($file)				
		{	
			case '':			
			{
				include 'Main.php';
			}
			break;
			case "$file":
			{
				include $file.'.php';
			}
		}
	}
?>