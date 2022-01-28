<?php
	class Survey extends DB{
		
		public $SurveyID;
		public $SurveyFieldsID;
		public $SurveyQuestionsID;
		
		public $Name;
		public $Status;
		public $Time;
		
		public function SurveyAdd()
		{
			$data = array(
				"Name"		=> $this->Name,
				"Status"	=> $this->Status,
				"Time"		=> time(),
			);
			
			$result = $this->insert("Survey", $data);
			
			if($result > 0)
			{
				$this->OutPutMessage = "<div class='alert alert-success'>Başarıyla Eklendi..</div>";
			}
			else
			{
				$this->OutPutMessage = "<div class='alert alert-success'>Hata Oluştu..</div>";
			}
			
		}
		
		public function SurveyEdit()
		{
			$data = array(
				"Name"		=> $this->Name,
			);
			
			$result = $this->update("Survey", $data, "ID=".$this->ID);
			
			if($result > 0)
			{
				$this->OutPutMessage = "<div class='alert alert-success'>Başarıyla Güncellendi..</div>";
			}
			else
			{
				$this->OutPutMessage = "<div class='alert alert-success'>Hata Oluştu..</div>";
			}
			
		}
		public function SurveyDelete($ID)
		{			
			$this->ID = intval($ID);
			
			$result = $this->connect->prepare("UPDATE Survey SET  ISDELETED = '1' WHERE ID = ?");

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
		public function SurveyList()
		{
			$result = $this->connect->query("SELECT * FROM Survey WHERE Status = 1 AND ISDELETED=0 ORDER BY ID DESC");
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function SurveyResultList($ID)
		{
			$result = $this->connect->prepare("SELECT * FROM SurveyResult WHERE SurveyID = ?");
			$result->execute(array($ID));
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function SurveyFindID($SurveyID)
		{
			$SurveyID = intval($SurveyID);
			
			$result = $this->connect->query("SELECT * FROM Survey WHERE Status = 1 AND ISDELETED=0 AND ID = ".$SurveyID);
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function SurveyFieldsAdd()
		{
			$data = array(
				"SurveyID"		=> $this->SurveyID,
				"Name"			=> $this->Name,
				"dateCreated"	=> date("Y-m-d H:i:s")
			);
			
			$result = $this->insert("SurveyFields", $data);
			
			if($result > 0)
			{
				$this->OutPutMessage = "<div class='alert alert-success'>Başarıyla Eklendi..</div>";
			}
			else
			{
				$this->OutPutMessage = "<div class='alert alert-success'>Hata Oluştu..</div>";
			}
			
		}
		public function SurveyFieldsEdit($ID)
		{
			$data = array(
				"Name"			=> $this->Name,
			);
			
			$result = $this->update("SurveyFields", $data, "ID=".$ID);
			
			if($result > 0)
			{
				$this->OutPutMessage = "<div class='alert alert-success'>Başarıyla Düzenlendi..</div>";
			}
			else
			{
				$this->OutPutMessage = "<div class='alert alert-success'>Hata Oluştu..</div>";
			}
			
		}
		public function SurveyFieldsDelete($ID)
		{			
			$this->ID = intval($ID);
			
			$result = $this->connect->prepare("UPDATE SurveyFields SET  ISDELETED = '1' WHERE ID = ?");

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
		public function SurveyFieldsList()
		{
			$result = $this->connect->query("SELECT Survey.ID AS SurveyID, SurveyFields.ID SurveyFieldsID, Survey.Name AS SurveyName, SurveyFields.Name AS SurveyFieldsName FROM Survey INNER JOIN SurveyFields ON Survey.ID = SurveyFields.SurveyID WHERE Survey.ISDELETED = 0 AND SurveyFields.ISDELETED=0");
					
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function SurveyQuestionsAdd()
		{
			$data = array(
				"SurveyID"		=> $this->SurveyID,
				"SurveyFieldsID"=> $this->SurveyFieldsID,
				"TypeID"		=> $this->TypeID,
				"Name"			=> $this->Name,
				"dateCreated"	=> date("Y-m-d H:i:s")
			);
			
			$result = $this->insert("SurveyQuestions", $data);
			
			if($result > 0)
			{
				$this->OutPutMessage = "<div class='alert alert-success'>Başarıyla Eklendi..</div>";
			}
			else
			{
				$this->OutPutMessage = "<div class='alert alert-success'>Hata Oluştu..</div>";
			}
			
		}
		public function SurveyQuestionsDelete($ID)
		{			
			$this->ID = intval($ID);
			
			$result = $this->connect->prepare("UPDATE SurveyQuestions SET  ISDELETED = '1' WHERE ID = ?");

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
		public function SurveyQuestionsList()
		{
			$result = $this->connect->query("SELECT Survey.ID AS SurveyID, Survey.Name AS SurveyName, SurveyFields.ID AS SurveyFieldsID, SurveyFields.Name AS SurveyFieldsName, SurveyQuestions.ID AS SurveyQuestionsID, SurveyQuestions.Name AS  SurveyQuestionsName FROM Survey INNER JOIN SurveyFields ON Survey.ID = SurveyFields.SurveyID INNER JOIN SurveyQuestions ON SurveyFields.ID = SurveyQuestions.SurveyFieldsID WHERE Survey.Status = 1 AND Survey.ISDELETED=0 AND SurveyFields.ISDELETED=0 AND SurveyQuestions.ISDELETED=0");
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function SurveyQuestionsFindID($SurveyID, $SurveyFieldsID)
		{
			$result = $this->connect->query("SELECT Survey.ID AS SurveyID, Survey.Name AS SurveyName, SurveyFields.ID AS SurveyFieldsID, SurveyFields.Name AS SurveyFieldsName, SurveyQuestions.ID AS SurveyQuestionsID, SurveyQuestions.Name AS  SurveyQuestionsName FROM Survey INNER JOIN SurveyFields ON Survey.ID = SurveyFields.SurveyID INNER JOIN SurveyQuestions ON SurveyFields.ID = SurveyQuestions.SurveyFieldsID WHERE Survey.Status = 1 AND Survey.ID = ".$SurveyID." AND SurveyQuestions.SurveyFieldsID = ".$SurveyFieldsID);
					
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function SurveyGeneralList($SurveyID, $SurveyFieldsID, $SurveyQuestionsID)
		{
			$result = $this->connect->query("SELECT Survey.ID AS SurveyID, Survey.Name AS SurveyName, SurveyFields.ID AS SurveyFieldsID, SurveyFields.Name AS SurveyFieldsName, SurveyQuestions.ID AS SurveyQuestionsID, SurveyQuestions.Name AS  SurveyQuestionsName FROM Survey INNER JOIN SurveyFields ON Survey.ID = SurveyFields.SurveyID INNER JOIN SurveyQuestions ON SurveyFields.ID = SurveyQuestions.SurveyFieldsID WHERE Survey.ID = ".$SurveyID." AND SurveyFields.ID = ".$SurveyFieldsID." AND SurveyQuestions.ID = ".$SurveyQuestionsID);
					
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function SurveyQuantityList($SurveyQuestionsID)
		{
			$result = $this->connect->query("SELECT * FROM SurveyQuantity WHERE SurveyQuestionsID = ".$SurveyQuestionsID." AND ISDELETED=0");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		
		public function SurveyFieldsID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT * FROM SurveyFields WHERE  ID = ?");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function SurveyFieldsGet($SurveyID)
		{
			$this->SurveyID = $SurveyID;
			
			$result = $this->connect->prepare("SELECT * FROM SurveyFields WHERE  SurveyID = ? AND ISDELETED=0");
			$result->execute(array($this->SurveyID));
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function SurveyQuestionsGet($SurveyFieldsID)
		{
			$this->SurveyFieldsID = $SurveyFieldsID;
			
			$result = $this->connect->prepare("SELECT * FROM SurveyQuestions WHERE  SurveyFieldsID = ? AND ISDELETED=0");
			$result->execute(array($this->SurveyFieldsID));
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function SurveyQuantityGet($SurveyQuestionsID)
		{
			$this->SurveyQuestionsID = $SurveyQuestionsID;
			
			$result = $this->connect->prepare("SELECT * FROM SurveyQuantity WHERE  SurveyQuestionsID = ? AND ISDELETED=0");
			$result->execute(array($this->SurveyQuestionsID));
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function SurveyQuantityAdd()
		{
			$data = array(
				"SurveyID"			=> $this->SurveyID,
				"SurveyFieldsID"	=> $this->SurveyFieldsID,
				"SurveyQuestionsID"	=> $this->SurveyQuestionsID,
				"Name"				=> $this->Name
			);
			
			$result = $this->insert("SurveyQuantity", $data);
			
			if($result > 0)
			{
				$this->OutPutMessage = "<div class='alert alert-success'>Başarıyla Eklendi..</div>";
			}
			else
			{
				$this->OutPutMessage = "<div class='alert alert-success'>Hata Oluştu..</div>";
			}
			
		}
		public function SurveyQuantityEdit($ID)
		{
			$data = array(
				"Name"			=> $this->Name,
			);
			
			$result = $this->update("SurveyQuantity", $data, "ID=".$ID);
			
			if($result > 0)
			{
				$this->OutPutMessage = "<div class='alert alert-success'>Başarıyla Düzenlendi..</div>";
			}
			else
			{
				$this->OutPutMessage = "<div class='alert alert-success'>Hata Oluştu..</div>";
			}
			
		}
		public function SurveyQuantityID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT * FROM SurveyQuantity WHERE  ID = ? AND ISDELETED=0");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function SurveyQuantityDelete($ID)
		{			
			$this->ID = intval($ID);
			
			$result = $this->connect->prepare("UPDATE SurveyQuantity SET  ISDELETED = '1' WHERE ID = ?");

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
		public function QuantityCount($QuantityID)
		{
			$result = $this->connect->query("SELECT COUNT(SurveyQuantityID) AS Counts FROM SurveyResult WHERE SurveyQuantityID = '".$QuantityID."'");
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line->Counts;
		}
	}
	
?>