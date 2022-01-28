<?php		
	if($Grants->GrantsControl($_GET['func']) == 0)
	{
		echo ViewReports::ErrorGrants();
	}
	else
	{
        $file = ($_GET['File']);
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