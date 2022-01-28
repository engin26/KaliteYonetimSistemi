<?php
	class Inbox extends DB{
		
		
		public function InboxDetails($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT * FROM Inbox WHERE ISDELETED = '0' AND ID = ?");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}

		public function InboxList()
		{
			
			$result = $this->connect->query("SELECT * FROM Inbox WHERE ISDELETED = '0' ORDER BY ID DESC");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}

		public function InboxDelete($ID)
		{			
			$this->ID = intval($ID);
			
			/*$resultImages = $this->connect->prepare("SELECT Images FROM Inbox WHERE ID = ?");
			$resultImages->execute(array($this->ID));
			$lineImages = $resultImages->fetch(PDO::FETCH_OBJ);
			
			$result = $this->connect->prepare("DELETE FROM Inbox WHERE ID = ?"); */
			$result = $this->connect->prepare("UPDATE Inbox  SET  ISDELETED = '1' WHERE ID = ?");

			$result = $result->execute(array($ID));
			
			if($result)
			{
				//unlink("../Uploads/Inbox/Big/".$lineImages->Images);
				
				$this->OutPutMessage =  ViewReports::Success("Başarıyla Silindi");
			}
			else
			{
				$this->OutPutMessage =  ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		
	}
	
?>