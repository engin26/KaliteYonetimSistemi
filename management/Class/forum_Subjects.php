<?php
	class forum_Subjects extends Library{
		public $ID;
		public $Name;
		public $SeoName;
		public $Click;
		public $Time;
		
		public $OutPutMessage;
		public $Status;
		public $CommentID;
		
		public function forum_SubjectsListUsers($UserID) // Seçilen kullanıcın yetkileri
		{
			$ID = array();

			$result = $this->connect->query("SELECT forum_Subjects.ID FROM forum_Subjects INNER JOIN forum_SubjectsGrants ON forum_Subjects.ID = forum_SubjectsGrants.SubjectsID WHERE forum_SubjectsGrants.ISDELETED = '0' AND UserID = '".$UserID."'");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			foreach($line as $line)
			{
				$ID[] = $line->ID;
			}
			return $ID;
		}
		public function forum_SubjectsList() // yetkiyi verenin yetkileri
		{
			$result = $this->connect->query("SELECT forum_Subjects.ID, forum_SubjectsGrants.UserID, forum_Subjects.Name, forum_Subjects.SeoName, forum_Subjects.Click FROM forum_Subjects INNER JOIN forum_SubjectsGrants ON forum_Subjects.ID = forum_SubjectsGrants.SubjectsID WHERE forum_SubjectsGrants.ISDELETED = '0' AND forum_Subjects.ISDELETED=0 AND UserID = '".$_SESSION['userID']."' ORDER BY forum_Subjects.Time DESC");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function forum_SubjectsFindID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT ID, Name, SeoName, Click FROM forum_Subjects WHERE ISDELETED = '0' AND ID = ?");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function forum_SubjectsAdd()
		{
			if($this->Name != '')
			{
				$data = array(
					"Name"		=>	DB::CLEAN_DATA($this->Name),
					"SeoName"	=>	$this->Seo($this->Name),
					"Time"		=>	time(),
					"ISDELETED"	=>	"0"
				);
				
				$result = DB::insert("forum_Subjects", $data);
				if($result > 0)
				{
					$this->ID = $result;
					$this->forum_SubjectsGrantsRootAdd();

					$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
				}
				else
				{
					$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
				}
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Lütfen boş bırakmayınız.!!!");
			}
		}
		public function forum_SubjectsGrantsRootAdd()
		{
			/* Açılan her konuyu root'un otomatik yetkisi olacaktır */

			$resultUserTypeRoot = $this->connect->query("SELECT ID FROM Users WHERE UserTypeID = 1");
			$lineUserTypeRoot = $resultUserTypeRoot->fetchAll(PDO::FETCH_OBJ);

			foreach($lineUserTypeRoot as $lineUserTypeRoot)
			{
				$data = array(
					"UserID"		=>	intval($lineUserTypeRoot->ID),
					"SubjectsID"	=>	intval($this->ID),
				);
				
				$result = $this->insert("forum_SubjectsGrants", $data);
			}
		}
		public function forum_SubjectsEdit($ID)
		{
			$this->ID = $ID;
			
			$data = array(
				"Name"		=>	DB::CLEAN_DATA($this->Name),
				"SeoName"	=>	Library::Seo($this->Name),
			);
			
			$result = DB::update("forum_Subjects", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function forum_SubjectsCommentsDelete($ID)
		{
			$ID = intval($ID);
			
			//$result = $this->connect->prepare("DELETE FROM forum_Subjects WHERE ID = ?");
			$result = $this->connect->prepare("UPDATE forum_Comments SET ISDELETED = '1' WHERE SubjectsID = ?");
			$result = $result->execute(array($ID));
			
			if($result)
			{
				$this->OutPutMessage .=  ViewReports::Success("Konuya Ait Yorumlar Silindi");
			}
			else
			{
				$this->OutPutMessage .=  ViewReports::Error("Konuya Ait Yorumları Silerken Hata Oluştu.!!!");
			}
		}
		public function forum_SubjectsDelete($ID)
		{
			$ID = intval($ID);
			
			//$result = $this->connect->prepare("DELETE FROM forum_Subjects WHERE ID = ?");
			$result = $this->connect->prepare("UPDATE forum_Subjects SET ISDELETED = '1' WHERE ID = ?");
			$result = $result->execute(array($ID));
			
			if($result)
			{
				$this->OutPutMessage =  ViewReports::Success("Başarıyla Silindi");
				$this->forum_SubjectsCommentsDelete($ID);
			}
			else
			{
				$this->OutPutMessage =  ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function forum_CommentList($ID)
		{
			$this->Name = $this->forum_SubjectsFindID($ID)->Name; // Yoruma Ait konuyu seçer

			if(isset($_GET['Approval']) && $_GET['Approval'] == 0)
			{
				$Where = " AND forum_Comments.Approval = :Approval";
				$parameter[':Approval'] = 0;
			}

			if(isset($_GET['Approval']) && $_GET['Approval'] == 1)
			{
				$Where = "AND forum_Comments.Approval = :Approval";
				$parameter[':Approval'] = 1;
			}

			$result = $this->connect->prepare("SELECT forum_Comments.ID, forum_Comments.UserID AS UserID, Users.UserName, Users.SurName,  SubjectsID, forum_Subjects.Name, forum_Comments.Comments, forum_Comments.Approval, forum_Comments.dateCreated  FROM forum_Subjects INNER JOIN forum_Comments  ON forum_Comments.SubjectsID = forum_Subjects.ID INNER JOIN Users ON Users.ID = forum_Comments.UserID WHERE forum_Comments.ISDELETED=0 AND forum_Comments.SubjectsID = :ID ".$Where." ORDER BY forum_Comments.dateCreated DESC");
			
			$parameter[':ID'] = $ID; 
			$result->execute($parameter);
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function forum_CommentFindID($ID)
		{
			$ID = intval($ID);

			$result = $this->connect->prepare("SELECT forum_Comments.ID, forum_Comments.UserID AS UserID, Users.UserName, Users.SurName, Users.Email, SubjectsID, forum_Subjects.Name, forum_Comments.Comments, forum_Comments.Approval, forum_Comments.dateCreated  FROM forum_Subjects INNER JOIN forum_Comments  ON forum_Comments.SubjectsID = forum_Subjects.ID INNER JOIN Users ON Users.ID = forum_Comments.UserID WHERE forum_Comments.ID = :ID");
			$result->execute(array(":ID" => $ID));
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function forum_CommentApprovalCount($SubjectsID, $Status)
		{
			$SubjectsID = intval($SubjectsID);
			$Status = intval($Status);

			$result = $this->connect->prepare("SELECT forum_Comments.ID, forum_Comments.UserID AS UserID, Users.UserName, Users.SurName,  SubjectsID, forum_Subjects.Name, forum_Comments.Comments, forum_Comments.Approval, forum_Comments.dateCreated  FROM forum_Subjects INNER JOIN forum_Comments  ON forum_Comments.SubjectsID = forum_Subjects.ID INNER JOIN Users ON Users.ID = forum_Comments.UserID WHERE forum_Comments.SubjectsID = :SubjectsID AND  forum_Comments.Approval=:Status AND forum_Comments.ISDELETED=0");
			$result->execute(array(":SubjectsID"=> $SubjectsID, ":Status" => $Status));
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function forum_SubjectsApproval($CommentID, $Status)
		{
			$CommentID = intval($CommentID);
			$Status = intval($Status);

			$System 	= $this->Settings(1); // Sistem ayarlarını çeker

			$lineDetails = $this->forum_CommentFindID($CommentID);
			
			$result = $this->connect->prepare("UPDATE forum_Comments SET Approval = :Status WHERE ID = :CommentID");
			$result->execute(array(":CommentID" => $CommentID, ":Status"=> $Status));
			

			if($result)
			{
				$Title = 'Yorumunuz Onaylandı - '.$System->Title;
				$Content = 'Merhaba '.$lineDetails->UserName." ". $lineDetails->SurName.'<br><br>'.$this->ucwords_tr($System->Title). '\'na yapmış oluğunuz yorum onaylanmıştır.';

				$this->SendMail($lineDetails->Email, $Title, $Content);

				$this->OutPutMessage =  ViewReports::Success("Başarıyla Güncellendi");
			}
			else
			{
				$this->OutPutMessage =  ViewReports::Error("Hata Oluştu.!!!");
			}
		}
	}
	
?>