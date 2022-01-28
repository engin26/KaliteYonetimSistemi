<?php
	class PagesCategories extends DB{
		public $ID;
		public $Name;
		public $SeoName;
		public $Click;
		public $Time;
		
		public $OutPutMessage;
		
		public function PagesCategoriesList()
		{
			$result = $this->connect->query("SELECT ID, Name, SeoName, Click FROM PagesCategories WHERE ISDELETED = '0'");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function PagesCategoriesFindID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT ID, Name, SeoName, Click FROM PagesCategories WHERE ISDELETED = '0' AND ID = ?");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function PagesCategoriesAdd()
		{
			$data = array(
				"Name"		=>	DB::CLEAN_DATA($this->Name),
				"SeoName"	=>	Library::Seo($this->Name),
				"ISDELETED"	=>	"0"
			);
			
			$result = DB::insert("PagesCategories", $data);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function PagesCategoriesEdit($ID)
		{
			$this->ID = $ID;
			
			$data = array(
				"Name"		=>	DB::CLEAN_DATA($this->Name),
				"SeoName"	=>	Library::Seo($this->Name)
			);
			
			$result = DB::update("PagesCategories", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function PagesCategoriesDelete($ID)
		{
			$ID = intval($ID);
			
			$result = $this->connect->prepare("UPDATE PagesCategories SET ISDELETED = '1' WHERE ID = ?");
			//$result = $this->connect->prepare("DELETE FROM PagesCategories WHERE ID = ?");
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