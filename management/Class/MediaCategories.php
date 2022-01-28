<?php
	class MediaCategories extends DB{
		public $ID;
		public $CatID;
		public $SupID;
		public $Name;
		public $URL;
		public $siraNo;
		public $Status;
		public $Click;
		public $Time;
		
		public $OutPutMessage;
		
		public function MediaCategoriesList($CatID, $SupID)
		{
			$result = $this->connect->prepare("SELECT ID, CatID, SupID, Name, URL, siraNo, Status, Click, Time FROM MediaCategories WHERE ISDELETED = '0' AND CatID = :CatID AND  SupID = :SupID ORDER BY siraNo ASC");
			$result->execute(array(':CatID' => $CatID, ':SupID' => $SupID));
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function MediaCategoriesFindID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT ID, CatID, SupID, Name, URL, siraNo, Status, Click, Time FROM MediaCategories WHERE ISDELETED = '0' AND ID = ?");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function MediaCategoriesAdd()
		{
			$data = array(
				"CatID"		=>	DB::CLEAN_DATA($this->CatID),
				"SupID"		=>	DB::CLEAN_DATA($this->SupID),
				"Name"		=>	DB::CLEAN_DATA($this->Name),
				"URL"		=>	DB::CLEAN_DATA($this->URL),
				"siraNo"	=>	DB::CLEAN_DATA($this->siraNo),
				"Status"	=>	DB::CLEAN_DATA($this->Status),
				"Click"		=>	DB::CLEAN_DATA($this->Click),
				"Time"		=>	time(),
				"ISDELETED"	=>	"0"
			);
			
			$result = DB::insert("MediaCategories", $data);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function MediaCategoriesEdit($ID)
		{
			$this->ID = $ID;
			
			$data = array(
				"Name"		=>	DB::CLEAN_DATA($this->Name),
				"URL"		=>	DB::CLEAN_DATA($this->URL),
				"siraNo"	=>	DB::CLEAN_DATA($this->siraNo),
				"Status"	=>	DB::CLEAN_DATA($this->Status),
				"Click"		=>	DB::CLEAN_DATA($this->Click),
				"Time"		=>	time(),
			);
			
			$result = DB::update("MediaCategories", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function MediaCategoriesDelete($ID)
		{
			$ID = intval($ID);
			
			$result = $this->connect->prepare("UPDATE MediaCategories SET ISDELETED = '1' WHERE ID = ?");
			//$result = $this->connect->prepare("DELETE FROM MediaCategories WHERE ID = ?");
			$result = $result->execute(array($ID));
			
			if($result)
			{
				$this->OutPutMessage =  ViewReports::Success("Başarıyla Silindi");
			}
			else
			{
				$this->OutPutMessage =  ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function CreateCategoriesSelect($katid, $onek = 1, $x='')
		{
			$result = $this->connect->query("SELECT * FROM MediaCategories WHERE SupID='$katid' AND ISDELETED = '0' ORDER BY siraNo ASC");
												 
			while($sonuc = $result->fetch(PDO::FETCH_OBJ))
			{
				if(!empty($sonuc))
				{
					$x = $x.str_repeat('#', $onek).$sonuc->ID.'&';
					$x = $this->CreateCategoriesSelect($sonuc->ID, ($onek+1), $x);
				}
			}
			return $x;
		}
		public function ReverseKatListele($katid, $onek = 1, $x='')
		{
			global $connect;
			$sql = $this->connect->query("SELECT * FROM MediaCategories WHERE ID='$katid' AND ISDELETED = '0' ORDER BY SupID ASC");
		 
			while($sonuc = $sql->fetch(PDO::FETCH_OBJ))
			{
				$result = $this->connect->query("SELECT SupID FROM MediaCategories WHERE ISDELETED = '0' AND SupID = '".$sonuc->SupID."' ORDER BY SupID ASC");
				$line = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($sonuc))
				{
					$x .=$sonuc->ID.',';
					$x = $this->ReverseKatListele($line->SupID, ($onek+1), $x);
				}
			}
			return $x;
		}
		public function GetReverseCategoriesListAll($ID)
		{
			$ProID = $this->ReverseKatListele($ID);
			$ProID = substr($ProID, 0,-1);
			if(!empty($ProID))
			{
				$ProID.=','.$ID;
			}
			else
			{
				$ProID = $ID;
			}
			return $ProID;
		}
		public function CreateBreadCrumb($ID)
		{
			$x = explode(",", $ID);
			
			$x = array_unique($x);
			foreach($x as $ID)
			{
				$result = $this->connect->query("SELECT * FROM MediaCategories WHERE ID = '".$ID."'");
				$line = $result->fetch(PDO::FETCH_OBJ);
				
				$Name[] = $line->Name;
			}
			$Name = array_reverse($Name);
			return implode(" / ", $Name);
		}
		
		public function katListele($katid, $onek = 1, $x='')
		{
			$sql = $this->connect->query("SELECT * FROM MediaCategories WHERE ISDELETED = '0' AND SupID='$katid'");
		 
			while($sonuc = $sql->fetch(PDO::FETCH_OBJ))
			{
				if(!empty($sonuc))
				{
					$x .=$sonuc->ID.',';
					$x = katListele($sonuc->ID, ($onek+1), $x);
				}
			}
			return $x;
		}
		public function GetCategoriesListAll($ID){
			$ProID = katListele($ID);
			$ProID = substr($ProID, 0,-1);
			if(!empty($ProID))
			{
				return $ProID.=','.$ID;
			}
			else
			{
				return $ProID = $ID;
			}
		}
		public function katListeleOption($katid, $onek = 1, $x='')
		{
			global $connect;
			$sql = $this->connect->query("SELECT * FROM MediaCategories WHERE ISDELETED = '0' AND SupID='$katid'");
		 
			while($sonuc = $sql->fetch(PDO::FETCH_OBJ))
			{
				if(!empty($sonuc))
				{
					$ID = $sonuc->ID;
					$x .= '<option>'.$ID.'</option>';
					$x = katListele($sonuc->ID, ($onek+1), $x);
				}
			}
			return $x;
		}
		function CategoriesWhere($SupID)
		{
			$SupID = intval($SupID);
			$result = $this->connect->query("SELECT * FROM MediaCategories WHERE ISDELETED = '0' AND ID='".$SupID."'");
			$line = $result->fetch(PDO::FETCH_OBJ);
			if(@$line->Name != '')
			{
				return "<a href='Profile.php?func=MediaCategories&ID=".$line->SupID."'>".$line->Name."</a>";
			}
			else
			{
				return "Ana Kategori";
			}
		}	
	}
	
?>