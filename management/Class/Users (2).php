<?php
	class Members extends DB{
		public $ID;
		public $JopsID;
		public $UserName;
		public $SurName;
		public $Email;
		public $Password;
		public $DOB;
		public $Gender;
		public $Address;
		public $PhoneNo;
		public $GSM;
		public $LastLogin;
		public $Status;
		public $UsersApproval;
		public $Time;
		
		public function MembersList()
		{
			$result = $this->connect->query("SELECT Members.ID, Jobs.ID AS JobsID, Jobs.Name AS JobsName, Members.UserName, Members.SurName, Members.Email, Members.DOB, Members.Gender, Members.Address, Members.PhoneNo, Members.GSM, Members.LastLogin, Members.Status, Members.UsersApproval, Members.Time FROM Jobs INNER JOIN Members ON Jobs.ID = Members.JobsID WHERE Members.ISDELETED = '0'");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function MembersFindID($ID)
		{
			$result = $this->connect->prepare("SELECT Members.ID, Jobs.ID AS JobsID, Jobs.Name AS JobsName, Members.UserName, Members.SurName, Members.Email, Members.DOB, Members.Gender, Members.Address, Members.PhoneNo, Members.GSM, Members.LastLogin, Members.Status, Members.UsersApproval, Members.Time FROM Jobs INNER JOIN Members ON Jobs.ID = Members.JobsID WHERE Members.ISDELETED = '0' AND Members.ID = ?");
			$result->execute(array($ID));
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function MembersDetails($ID)
		{
			$result = $this->connect->prepare("SELECT Members.ID, Jobs.ID AS JobsID, Jobs.Name AS JobsName, Members.UserName, Members.SurName, Members.Email, Members.DOB, Members.Gender, Members.Address, Members.PhoneNo, Members.GSM, Members.LastLogin, Members.Status, Members.UsersApproval, Members.Time FROM Jobs INNER JOIN Members ON Jobs.ID = Members.JobsID WHERE Members.ISDELETED = '0' AND Members.ID = ?");
			$result->execute(array($ID));
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function MembersDelete($ID)
		{
			$ID = intval($ID);
			
			//$result = $this->connect->prepare("DELETE FROM Members WHERE ID = ?");
			$result = $this->connect->prepare("UPDATE Members SET ISDELETED = '1' WHERE ID = ?");
			$result = $result->execute(array($ID));
			
			if($result)
			{
				$this->OutPutMessage =  ViewReports::Success("Silindi");
			}
			else
			{
				$this->OutPutMessage =  ViewReports::Error("Hata");
			}
		}
		public function MembersUsersApproval($Status, $ID)
		{
			$ID = intval($ID);
			$Status = intval($Status);
			$lineMembers = $this->MembersFindID($ID);

			$System =Library::Settings(1);

			$result = $this->connect->prepare("UPDATE Members SET UsersApproval = ? WHERE ID = ?");
			$result = $result->execute(array($Status, $ID));
			

			if($result)
			{
				Library::SendMail($lineMembers->Email, 'Üyeliğiniz Onaylandı - '.$System->Title, 'Merhaba '.$lineMembers->UserName." ". $lineMembers->SurName.'<br><br>'.Library::ucwords_tr($System->Title). '\'na yapmış oluğunuz site üyelik başvurunuz onaylanmıştır.');
				$this->OutPutMessage =  ViewReports::Success("Üye Onaylandı");
			}
			else
			{
				$this->OutPutMessage =  ViewReports::Error("Hata");
			}
		}
	}
	
?>