<?php
		$start = microtime(true);
		session_start();
		date_default_timezone_set('Europe/Helsinki');
		setlocale(LC_TIME,'turkish');
		ob_start();
		header ('Content-type: text/html; charset=utf-8');

		include 'Class/System/Config.php';
		include 'Class/System/DB.php';

		include 'Class/System/Defined.php';
		include 'Class/System/Library.php';
		include 'phpmailer/class.phpmailer.php';

		include Defined::PATH_CLASS_SYSTEM.'Session.php';
		include Defined::PATH_CLASS_SYSTEM.'TempLog.php';
		include Defined::PATH_CLASS_SYSTEM.'ViewReports.php';
		include Defined::PATH_CLASS_SYSTEM.'Model.php';
		include Defined::PATH_CLASS_SYSTEM.'class.upload.php';


		include Defined::PATH_CLASS.'Users.php';
		include Defined::PATH_CLASS_SYSTEM.'Grants.php';

		$Grants = new Grants();
		$Session = new Session();
		$Session->SessionControl();

		$_SESSION['isLoggedIn'] = true;


?>
