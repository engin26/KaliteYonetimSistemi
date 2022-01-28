<?php
	class Settings extends DB{
		public $ID;
		public $Title;
		public $Description;
		public $Keywords;
		public $Facebook;
		public $Twitter;
		public $Youtube;
		public $GooglePlus;
		public $Instagram;
		public $Email;
		public $Years;
		public $WebSite;
		public $URL;
		public $DemoURL;
		public $EmailURL;
		public $ManagementURL;
		public $Author;
		public $Footer;
		
		public function SettingsList($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT * FROM settings WHERE ISDELETED = '0' AND ID = ?");
			
			
			$data = array($this->ID);
			
			$result->execute($data);
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
			
		}
		public function SettingsEdit($ID)
		{
				$this->ID = $ID;
				
				
				$data = array(
					"Title"			=>	DB::CLEAN_DATA($this->Title),
					"Description"	=>	DB::CLEAN_DATA($this->Description),
					"Keywords"		=>	DB::CLEAN_DATA($this->Keywords),
					"Facebook"		=>	DB::CLEAN_DATA($this->Facebook),
					"Twitter"		=>	DB::CLEAN_DATA($this->Twitter),
					"Youtube"		=>	DB::CLEAN_DATA($this->Youtube),
					"GooglePlus"	=>	DB::CLEAN_DATA($this->GooglePlus),
					"Instagram"		=>	DB::CLEAN_DATA($this->Instagram),
					"Linkedin"		=>	DB::CLEAN_DATA($this->Linkedin),
					"Email"			=>	DB::CLEAN_DATA($this->Email),
					"Years"			=>	DB::CLEAN_DATA($this->Years),
					"WebSite"		=>	DB::CLEAN_DATA($this->WebSite),
					"URL"			=>	DB::CLEAN_DATA($this->URL),
					"DemoURL"		=>	DB::CLEAN_DATA($this->DemoURL),
					"EmailURL"		=>	DB::CLEAN_DATA($this->EmailURL),
					"ManagementURL"	=>	DB::CLEAN_DATA($this->ManagementURL),
					"Author"		=>	DB::CLEAN_DATA($this->Author),
					"Footer"		=>	DB::CLEAN_DATA($this->Footer),
					
				);
				
				$result = DB::update("settings", $data, "ID=".$this->ID);
				
				if($result > 0)
				{ 
					$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
				}
				else
				{
					$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
				}
			
		}
	}
	
?>