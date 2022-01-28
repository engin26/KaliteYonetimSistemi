<?php
	class Tenders extends DB{
		public $ID;
		public $TendersTypeID;
		public $TendersProcedureID;
		public $Header;
		public $RecordNo;
		public $DATETIME;
		public $DATETODO;
		public $FileInformation;
		public $FileTenders;
		public $FileDocuments;
		public $Status;
		public $Time;
		public $ISDELETED;
		
		public $OutPutMessage;
		public $OutPutMessageImages;

		public $OutPutMessage_FileInformation;
		public $OutPutMessage_FileTenders;
		public $OutPutMessage_FileDocuments;
		
		public function TendersList()
		{
			
			$result = $this->connect->query("
					SELECT Tenders.ID, TendersType.Name AS TendersTypeName, TendersProcedure.Name AS TendersProcedureName, Tenders.Header, Tenders.RecordNo, Tenders.DATETIME, Tenders.DATETODO, Tenders.FileInformation, Tenders.FileTenders, Tenders.FileDocuments 
					FROM Tenders 
					INNER JOIN TendersType ON Tenders.TendersTypeID = TendersType.ID
					INNER JOIN TendersProcedure ON Tenders.TendersProcedureID = TendersProcedure.ID
					WHERE Tenders.ISDELETED = '0' AND Tenders.Status = '1'
					ORDER BY ID DESC 
			");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function TendersFindID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT Tenders.ID, TendersType.ID AS TendersTypeID, TendersType.Name AS TendersTypeName, TendersProcedure.ID AS TendersProcedureID, TendersProcedure.Name AS TendersProcedureName, Tenders.Header, Tenders.RecordNo, Tenders.DATETIME, Tenders.DATETODO, Tenders.FileInformation, Tenders.FileTenders, Tenders.FileDocuments 
					FROM Tenders 
					INNER JOIN TendersType ON Tenders.TendersTypeID = TendersType.ID
					INNER JOIN TendersProcedure ON Tenders.TendersProcedureID = TendersProcedure.ID
					WHERE Tenders.ISDELETED = '0' AND Tenders.Status = '1' AND Tenders.ID = ?
					ORDER BY ID DESC");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function TendersAdd()
		{
				$Time = time();
				if($_FILES['FileInformation']['name'] != '')
				{

					if($_FILES['FileInformation'])
					{
						$file = new Upload($_FILES['FileInformation'], 'TR_tr');

						$FileInformation = time().'_'.Library::Random(5);
						$file->file_new_name_body = $FileInformation;


						$file->allowed = array('application/msword', "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.ms-excel", "application/pdf");
						$file->Process('../Uploads/Tenders/FileInformation/');
						if ($file->processed)
						{
							$FileInformationStatus = '1';
							$FileInformation .= '.'.$file->file_src_name_ext;
						} 
						else
						{
							$this->OutPutMessage_FileInformation = ViewReports::Error("Bilgi Dosyasından Hata Oluştu : ".$file->error);
						}   
					}
				}
				if($_FILES['FileTenders']['name'] != '')
				{
					if($_FILES['FileTenders'])
					{
						$file = new Upload($_FILES['FileTenders']);

						$FileTenders = time().'_'.Library::Random(5);
						$file->file_new_name_body = $FileTenders;
						$file->Process('../Uploads/Tenders/FileTenders/');
						if ($file->processed) 
						{
							$FileTendersStatus = '1';
							$FileTenders .= '.'.$file->file_src_name_ext;
						} 
						else
						{
							$this->OutPutMessage_FileTenders = ViewReports::Error("İhale Dosyasında Hata Oluştu.!!!".$file->error);
						}   
					}
				}
				if($_FILES['FileDocuments']['name'] != '')
				{
					if($_FILES['FileDocuments'])
					{
						$file = new Upload($_FILES['FileDocuments']);

						$FileDocuments = time().'_'.Library::Random(5);
						$file->file_new_name_body = $FileDocuments;
						$file->Process('../Uploads/Tenders/FileDocuments/');
						
						if ($file->processed) 
						{
							$FileDocuments .= '.'.$file->file_src_name_ext;
						} 
						else
						{
							$this->OutPutMessage_FileDocuments = ViewReports::Error("Döküman Dosyasında Hata Oluştu.!!!".$file->error);
						}   
					}
				}
				$data = array(
					"TendersTypeID"			=>	intval($this->TendersTypeID),
					"TendersProcedureID"	=>	intval($this->TendersProcedureID),
					"Header"				=>	DB::CLEAN_DATA($this->Header),
					"RecordNo"				=>	DB::CLEAN_DATA($this->RecordNo),
					"DATETIME"				=>	DB::SQL_INJECTION($this->DATETIME),
					"DATETODO"				=>	DB::SQL_INJECTION($this->DATETODO),
					"FileInformation"		=>	$FileInformation,
					"FileTenders"			=>	$FileTenders,
					"FileDocuments"			=>	$FileDocuments,
					"Status"				=>	"1",
					"Time"					=>	$Time,
					"ISDELETED"				=>	"0"
				);
				$result = DB::insert("Tenders", $data);
				if($result > 0)
				{
					$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
				}
				else
				{
					$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
				}
			
		}
		public function TendersEdit($ID)
		{
			$this->ID = $ID;
			
			$Time = time();
				if($_FILES['FileInformation']['name'] != '')
				{

					if($_FILES['FileInformation'])
					{
						$file = new Upload($_FILES['FileInformation'], 'TR_tr');

						$FileInformation = time().'_'.Library::Random(5);
						$file->file_new_name_body = $FileInformation;


						$file->allowed = array('application/msword', "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.ms-excel", "application/pdf");
						$file->Process('../Uploads/Tenders/FileInformation/');
						if ($file->processed)
						{
							$FileInformationStatus = '1';
							$FileInformation .= '.'.$file->file_src_name_ext;
						} 
						else
						{
							$this->OutPutMessage_FileInformation = ViewReports::Error("Bilgi Dosyasından Hata Oluştu : ".$file->error);
						}   
					}
				}
				if($_FILES['FileTenders']['name'] != '')
				{
					if($_FILES['FileTenders'])
					{
						$file = new Upload($_FILES['FileTenders']);

						$FileTenders = time().'_'.Library::Random(5);
						$file->file_new_name_body = $FileTenders;
						$file->Process('../Uploads/Tenders/FileTenders/');
						if ($file->processed) 
						{
							$FileTendersStatus = '1';
							$FileTenders .= '.'.$file->file_src_name_ext;
						} 
						else
						{
							$this->OutPutMessage_FileTenders = ViewReports::Error("İhale Dosyasında Hata Oluştu.!!!".$file->error);
						}   
					}
				}
				if($_FILES['FileDocuments']['name'] != '')
				{
					if($_FILES['FileDocuments'])
					{
						$file = new Upload($_FILES['FileDocuments']);

						$FileDocuments = time().'_'.Library::Random(5);
						$file->file_new_name_body = $FileDocuments;
						$file->Process('../Uploads/Tenders/FileDocuments/');
						
						if ($file->processed) 
						{
							$FileDocuments .= '.'.$file->file_src_name_ext;
						} 
						else
						{
							$this->OutPutMessage_FileDocuments = ViewReports::Error("Döküman Dosyasında Hata Oluştu.!!!".$file->error);
						}   
					}
				}
				$data = array(
					"TendersTypeID"			=>	intval($this->TendersTypeID),
					"TendersProcedureID"	=>	intval($this->TendersProcedureID),
					"Header"				=>	DB::CLEAN_DATA($this->Header),
					"RecordNo"				=>	DB::CLEAN_DATA($this->RecordNo),
					"DATETIME"				=>	DB::SQL_INJECTION($this->DATETIME),
					"DATETODO"				=>	DB::SQL_INJECTION($this->DATETODO),
					"FileInformation"		=>	$FileInformation,
					"FileTenders"			=>	$FileTenders,
					"FileDocuments"			=>	$FileDocuments,
					"Status"				=>	"1",
					"Time"					=>	$Time,
					"ISDELETED"				=>	"0"
				);

			$result = DB::update("Tenders", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function TendersDelete($ID)
		{			
			$this->ID = intval($ID);
			
			/*$resultImages = $this->connect->prepare("SELECT Images FROM News WHERE ID = ?");
			$resultImages->execute(array($this->ID));
			$lineImages = $resultImages->fetch(PDO::FETCH_OBJ);
			
			$result = $this->connect->prepare("DELETE FROM News WHERE ID = ?");
			$result = $result->execute(array($ID));*/

			$result = $this->connect->prepare("UPDATE Tenders SET ISDELETED = '1' WHERE ID = ?");
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
		public function TendersTypeList()
		{
			$result = $this->connect->prepare("SELECT ID, Name FROM TendersType WHERE ISDELETED = '0' AND Status = '1'");
			$result->execute();

			$line = $result->fetchAll(PDO::FETCH_OBJ);

			return $line;
		}
		public function TendersProcedureList()
		{
			$result = $this->connect->prepare("SELECT ID, Name FROM TendersProcedure WHERE ISDELETED = '0' AND Status = '1'");
			$result->execute();

			$line = $result->fetchAll(PDO::FETCH_OBJ);

			return $line;
		}
	}
	
?>