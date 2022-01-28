<?php
	class Session{
	
		public static function getSession($Name)
		{
			return $_SESSION[$Name];
		}
		public static function unsetSession($Name)
		{
			unset($_SESSION[$Name]);
		}
		function SessionControl()
		{
			if($this->getSession("UserID") == "" || $this->getSession("UserTypeID") == "")
			{
				/*print "Lütfen Oturum Açınız.!!!";
				//header("Location:index.php");
				exit(); */
			}
		}	
	}
?>