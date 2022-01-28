<?php
	/* KULLANICILARIN YETKİSİNİ KONTROL EDER */
	class grants extends users{
		
		public function __construct()
		{
			parent::__construct();			
		}
		public function TableGrants($func)
		{
			$result = $this->connect->prepare("SELECT COUNT(Tables) AS Counts FROM grants WHERE UserID = ? AND Tables = ?");
			$result->execute(array($_SESSION['userID'], $func));
			
			$lineGrants = $result->fetch(PDO::FETCH_OBJ);
			
			return $lineGrants;	
		}	
		public function UserTypeGrants($func)
		{
			$result = $this->connect->prepare("SELECT COUNT(Tables) AS Counts FROM usertypegrants WHERE UserTypeID = ? AND Tables = ?");
			$result->execute(array($_SESSION['userTypeID'], $func));
			
			$lineGrants = $result->fetch(PDO::FETCH_OBJ);
			
			return $lineGrants;
		}
		public function GrantsControl($func) // sayfaya yetki var mı diye bakılır
		{
			$lineUserGrants = $this->TableGrants($func);
            $lineUserTypeGrants = $this->UserTypeGrants($func);
			
            if($lineUserGrants->Counts == 1 || $lineUserTypeGrants->Counts == 1)
            {
				return 1;
			}		
            else
            {
				return 0;
			}
		}
		public function RootView() // sadece root'a görünmek için
		{
			if($_SESSION['userTypeID'] == 1)
				return true;
			else
				return false;
		}
	}
?>