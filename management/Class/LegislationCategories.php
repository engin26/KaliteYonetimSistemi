<?php
	class LegislationCategories extends DB{
		public $ID;
		public $Name;
		public $SeoName;
		public $Click;
		public $Time;
		
		public $OutPutMessage;
		
		public function LegislationCategoriesList()
		{
			$result = $this->connect->query("SELECT ID, Name, SeoName, Click FROM LegislationCategories WHERE ISDELETED = '0'");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function LegislationCategoriesFindID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT ID, Name, SeoName, Click FROM LegislationCategories WHERE ISDELETED = '0' AND ID = ?");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function LegislationCategoriesAdd()
		{
			$data = array(
				"Name"		=>	DB::CLEAN_DATA($this->Name),
				"SeoName"	=>	Library::Seo($this->Name),
				"ISDELETED"	=>	"0"
			);
			
			$result = DB::insert("LegislationCategories", $data);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function LegislationCategoriesEdit($ID)
		{
			$this->ID = $ID;
			
			$data = array(
				"Name"		=>	DB::CLEAN_DATA($this->Name),
				"SeoName"	=>	Library::Seo($this->Name),
			);
			
			$result = DB::update("LegislationCategories", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function LegislationCategoriesDelete($ID)
		{
			$ID = intval($ID);
			
			//$result = $this->connect->prepare("DELETE FROM LegislationCategories WHERE ID = ?");
			$result = $this->connect->prepare("UPDATE LegislationCategories SET ISDELETED = '1' WHERE ID = ?");
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