<?php
	class NewsLetters extends DB{
		public $ID;
		public $NewsLettersCategoriesID;
		public $Header;
		public $SeoName;
		public $ShortContent;
		public $Content;
		public $Images;
		public $Link;
		public $Click;
		public $Time;
		
		public $OutPutMessage;
		public $OutPutMessageImages;
		
		public function NewsLettersList()
		{
			
			$result = $this->connect->query("SELECT NewsLetters.ID, NewsLetters.Name, NewsLetters.Header, NewsLetters.SeoName,NewsLetters.Content FROM NewsLetters WHERE ISDELETED = '0'");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function NewsLettersFindID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT NewsLetters.ID, NewsLetters.Name, NewsLetters.Header, NewsLetters.SeoName,NewsLetters.Content FROM NewsLetters WHERE ISDELETED = '0' AND NewsLetters.ID = ?");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function NewsLettersLastID()
		{
			
			$result = $this->connect->prepare("SELECT NewsLetters.ID, NewsLetters.Name, NewsLetters.Header, NewsLetters.SeoName,NewsLetters.Content FROM NewsLetters WHERE ISDELETED = '0' ORDER BY ID DESC LIMIT 0,1");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function NewsLettersAdd()
		{
			$data = array(
				//"Name"					=>	DB::CLEAN_DATA($this->Name),
				"Header"				=>	DB::CLEAN_DATA($this->Header),
				"SeoName"				=>	Library::Seo($this->Name),
				"Content"				=>	DB::SQL_INJECTION($this->Content),
				"Time"					=>	time(),
				"ISDELETED"				=>	"0"
			);
			if($_POST['c'] != '')
			{
				$EmailListCategoriesListID = implode(',',$_POST['c']);
				$resultEmailList = $this->connect->query("SELECT ID, CatID, CatName, UserName, SurName, Email FROM vw_EmailList WHERE CatID IN(".$EmailListCategoriesListID.")");

				$lineEmailList = $resultEmailList->fetchAll(PDO::FETCH_OBJ);

				foreach ($lineEmailList as $lineEmailList) 
				{
					Library::SendMail($lineEmailList->Email, $this->Header, $this->Content);
				}
			}
			// Üyeler için 1001 Value Verildi. İşaretliyse Members lara Gidiyor.
			if($_POST['Uyeler'] == '1001')
			{
				$resultMembersEmailList = $this->connect->query("SELECT Email FROM Members WHERE ISDELETED = '0' AND Status = '1' AND UsersApproval = '1'");

				$lineMembersEmailList = $resultMembersEmailList->fetchAll(PDO::FETCH_OBJ);

				foreach ($lineMembersEmailList as $lineMembersEmailList) 
				{
					Library::SendMail($lineMembersEmailList->Email, $this->Header, $this->Content);
				}
			}
			$result = DB::insert("NewsLetters", $data);

			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}		
		}
		public function NewsLettersEdit($ID)
		{
			$this->ID = $ID;
			
			/*$data = array(
				//"Name"					=>	DB::CLEAN_DATA($this->Name),
				"Header"				=>	DB::CLEAN_DATA($this->Header),
				"SeoName"				=>	Library::Seo($this->Name),
				"Content"				=>	DB::SQL_INJECTION($this->Content),
				"Time"					=>	time()
			);
			$result = DB::update("NewsLetters", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}*/
			$data = array(
				//"Name"					=>	DB::CLEAN_DATA($this->Name),
				"Header"				=>	DB::CLEAN_DATA($this->Header),
				"SeoName"				=>	Library::Seo($this->Name),
				"Content"				=>	DB::SQL_INJECTION($this->Content),
				"Time"					=>	time(),
				"ISDELETED"				=>	"0"
			);
			if($_POST['c'] != '')
			{
				$EmailListCategoriesListID = implode(',',$_POST['c']);
				$resultEmailList = $this->connect->query("SELECT ID, CatID, CatName, UserName, SurName, Email FROM vw_EmailList WHERE CatID IN(".$EmailListCategoriesListID.")");

				$lineEmailList = $resultEmailList->fetchAll(PDO::FETCH_OBJ);

				foreach ($lineEmailList as $lineEmailList) 
				{
					Library::SendMail($lineEmailList->Email, $this->Header, $this->Content);
				}
			}
			// Üyeler için 1001 Value Verildi. İşaretliyse Members lara Gidiyor.
			if($_POST['Uyeler'] == '1001')
			{
				$resultMembersEmailList = $this->connect->query("SELECT Email FROM Members WHERE ISDELETED = '0' AND Status = '1' AND UsersApproval = '1'");

				$lineMembersEmailList = $resultMembersEmailList->fetchAll(PDO::FETCH_OBJ);

				foreach ($lineMembersEmailList as $lineMembersEmailList) 
				{
					Library::SendMail($lineMembersEmailList->Email, $this->Header, $this->Content);
					sleep(2);
				}
			}
			$result = DB::update("NewsLetters", $data, "ID = ".$this->ID);

			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi ve Mail Gönderildi.");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}		
		}
		public function NewsLettersDelete($ID)
		{
			$this->ID = intval($ID);
			
			//$result = $this->connect->prepare("DELETE FROM NewsLetters WHERE ID = ?");
			
			$result = $this->connect->prepare("UPDATE NewsLetters SET ISDELETED = '1' WHERE ID = ?");
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
		public function EmailListList()
		{
			
			$result = $this->connect->query("SELECT ID, CatID, CatName, UserName, SurName, Email FROM vw_EmailList");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function EmailListCategoriesList()
		{
			
			$result = $this->connect->query("SELECT ID, Name FROM EmailListCategories WHERE Status = '1'");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
	}
	
?>