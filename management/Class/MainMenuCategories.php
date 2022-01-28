<?php
	class MainMenuCategories extends DB{
		public $ID;
		public $Name;
		public $SeoName;
		public $Click;
		public $Time;
		
		public $OutPutMessage;
		
		public function MainMenuCategoriesList()
		{
			$result = $this->connect->query("SELECT ID, Name, SeoName, Click FROM MainMenuCategories WHERE ISDELETED = '0'");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function MainMenuCategoriesFindID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT ID, Name, SeoName, Click FROM MainMenuCategories WHERE ISDELETED = '0' AND ID = ?");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function MainMenuCategoriesAdd()
		{
			$data = array(
				"Name"		=>	DB::CLEAN_DATA($this->Name),
				"SeoName"	=>	Library::Seo($this->Name),
				"ISDELETED"	=>	"0"
			);
			
			$result = DB::insert("MainMenuCategories", $data);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function MainMenuCategoriesEdit($ID)
		{
			$this->ID = $ID;
			
			$data = array(
				"Name"		=>	DB::CLEAN_DATA($this->Name),
				"SeoName"	=>	Library::Seo($this->Name),
			);
			
			$result = DB::update("MainMenuCategories", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function MainMenuCategoriesDelete($ID)
		{
			$ID = intval($ID);
			
			//$result = $this->connect->prepare("DELETE FROM MainMenuCategories WHERE ID = ?");
			$result = $this->connect->prepare("UPDATE MainMenuCategories SET ISDELETED = '0' WHERE ID = ?");
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
		
	}
	
?>