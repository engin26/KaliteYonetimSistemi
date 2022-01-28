<?php
	class forum_SubjectsGrants extends Users{
		public $ID;
		public $UserID;
		public $UserTypeID;
		public $SubjectsID;
		
		public $OutPutMessage;
		
		public function forum_SubjectsGrantsList($ID)
		{

			$result = $this->connect->prepare("SELECT forum_SubjectsGrants.ID, Users.ID AS UserID, forum_Subjects.ID AS SubjectsID, forum_Subjects.Name AS SubjectsName 
											 FROM forum_SubjectsGrants 
											 INNER JOIN forum_Subjects ON forum_Subjects.ID = forum_SubjectsGrants.SubjectsID
											 INNER JOIN Users ON Users.ID = forum_SubjectsGrants.UserID
											 WHERE Users.ID = :UserID AND forum_SubjectsGrants.ISDELETED = '0'");
			
			$parameter = array(":UserID" => $ID);

			$result->execute($parameter);

			$line = $result->fetchAll(PDO::FETCH_OBJ);
			return $line;
		}
		
		public function forum_SubjectsGrantsDelete($ID)
		{
			$ID = intval($ID);
			//$result = $this->connect->prepare("DELETE FROM forum_SubjectsGrants WHERE ID = ?");
			$result = $this->connect->prepare("UPDATE forum_SubjectsGrants SET ISDELETED = '1' WHERE ID = ?");
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
		public function forum_SubjectsGrantsAdd()
		{
			$data = array(
				"UserID"		=>	intval($this->UserID),
				"SubjectsID"	=>	intval($this->SubjectsID),
			);
			
			$result = $this->insert("forum_SubjectsGrants", $data);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		/**---------------------------------------------------------------------------------------------------------------------------------*/
		/*public function forum_SubjectsGrantsList()
		{
			$result = $this->connect->query("SELECT ID, Name, SeoName, Click FROM forum_SubjectsGrants WHERE ISDELETED = '0'");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function forum_SubjectsGrantsFindID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT ID, Name, SeoName, Click FROM forum_SubjectsGrants WHERE ISDELETED = '0' AND ID = ?");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function forum_SubjectsGrantsAdd()
		{
			$data = array(
				"Name"		=>	DB::CLEAN_DATA($this->Name),
				"SeoName"	=>	$this->Seo($this->Name),
				"ISDELETED"	=>	"0"
			);
			
			$result = DB::insert("forum_SubjectsGrants", $data);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function forum_SubjectsGrantsEdit($ID)
		{
			$this->ID = $ID;
			
			$data = array(
				"Name"		=>	DB::CLEAN_DATA($this->Name),
				"SeoName"	=>	Library::Seo($this->Name),
			);
			
			$result = DB::update("forum_SubjectsGrants", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function forum_SubjectsGrantsDelete($ID)
		{
			$ID = intval($ID);
			
			//$result = $this->connect->prepare("DELETE FROM forum_SubjectsGrants WHERE ID = ?");
			$result = $this->connect->prepare("UPDATE forum_SubjectsGrants SET ISDELETED = '1' WHERE ID = ?");
			$result = $result->execute(array($ID));
			
			if($result)
			{
				$this->OutPutMessage =  ViewReports::Success("Başarıyla Silindi");
			}
			else
			{
				$this->OutPutMessage =  ViewReports::Error("Hata Oluştu.!!!");
			}
		}*/
		
	}
	
?>