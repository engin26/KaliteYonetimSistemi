<?php
	class Files extends DB{
		public $ID;
		public $Name;
		public $SeoName;
		public $Header;
		public $ShortContent;
		public $Content;
		public $Images;
		public $Link;
		public $Description;
		public $Keywords;
		public $Time;

		public $OutPutMessage;
		public $OutPutMessageImages;


		function Seo($url)
		{
			$url = trim($url);
			$find = array('<b>', '</b>');
			$url = str_replace ($find, '', $url);
			$url = preg_replace('/<(\/{0,1})img(.*?)(\/{0,1})\>/', 'image', $url);
			$find = array(' ', '&amp;amp;amp;quot;', '&amp;amp;amp;amp;', '&amp;amp;amp;', '\r\n', '\n', '/', '\\', '+', '<', '>');
			$url = str_replace ($find, '-', $url);
			$find = array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ë', 'Ê');
			$url = str_replace ($find, 'e', $url);
			$find = array('í', 'ý', 'ì', 'î', 'ï', 'I', 'Ý', 'Í', 'Ì', 'Î', 'Ï','İ','ı');
			$url = str_replace ($find, 'i', $url);
			$find = array('ó', 'ö', 'Ö', 'ò', 'ô', 'Ó', 'Ò', 'Ô');
			$url = str_replace ($find, 'o', $url);
			$find = array('á', 'ä', 'â', 'à', 'â', 'Ä', 'Â', 'Á', 'À', 'Â');
			$url = str_replace ($find, 'a', $url);
			$find = array('ú', 'ü', 'Ü', 'ù', 'û', 'Ú', 'Ù', 'Û');
			$url = str_replace ($find, 'u', $url);
			$find = array('ç', 'Ç');
			$url = str_replace ($find, 'c', $url);
			$find = array('þ', 'Þ','ş','Ş');
			$url = str_replace ($find, 's', $url);
			$find = array('ð', 'Ð','ğ','Ğ');
			$url = str_replace ($find, 'g', $url);
			$find = array('/[^A-Za-z0-9\-<>]/', '/[\-]+/', '/<[^>]*>/');
			$repl = array('', '-', '');
			$url = preg_replace ($find, $repl, $url);
			$url = str_replace ('--', '-', $url);
			$url = strtolower($url);
			return $url;
		}


		public function FileCategoriesList()
		{
			$result = $this->connect->prepare("SELECT * FROM FilesCategories");
			$result->execute();
			$line = $result->fetchAll(PDO::FETCH_OBJ);

			return $line;
		}
		public function FileNoDuplicate($FileNo){
					$FileNo = trim($FileNo);
					$result = $this->connect->prepare("SELECT * FROM Files WHERE FileNo = ?");
					$result->execute(array($FileNo));

					return $result->rowCount();
				}



		public function FileCategoriesFindID($ID)
		{
			$ID = intval($ID);

			$result = $this->connect->prepare("SELECT * FROM FilesCategories WHERE ID = ?");
			$result->execute(array($ID));
			$line = $result->fetch(PDO::FETCH_OBJ);

			return $line;
		}
		public function FilesList()
		{

			$result = $this->connect->prepare("SELECT * FROM Files WHERE ISDELETED = '0' Order by ID DESC");
			$result->execute();
			$line = $result->fetchAll(PDO::FETCH_OBJ);

			return $line;
		}
		public function FilesFindID($ID)
		{
			$this->ID = $ID;

			$result = $this->connect->prepare("SELECT * FROM Files WHERE ISDELETED = '0' AND ID = ?");
			$result->execute(array($this->ID));

			$line = $result->fetch(PDO::FETCH_OBJ);

			return $line;
		}
		public function FilesAdd()
		{
				$Files = '';
				if($_FILES['Files']['name'] != '')
				{
					if($_FILES['Files'])
					{
						$files = $_FILES['Files'];
						$file = new Upload($files, 'tr_TR');


						$Time = time();
						$Random = rand(110, 999999);
						$FilesExt = $file->file_src_name_ext;
						$FilesName = $file->file_new_name_body = $this->Seo($file->file_src_name_body).'_'.$Random;

						$file->allowed = array ( "application/rar",'application/x-rar',"image/*","application/zip","application/x-rar-compressed","application/x-rar",'application/msword', "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "application/vnd.ms-excel", "application/pdf",'application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/zip','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );
						$file->Process('../Uploads/Files/');

						if($file->processed)
						{
							$this->OutPutMessageImages = "Dosya Başarıyla Eklendi, Lütfen Bekleyiniz";
							$Upload = 1;

							$Files = $FilesName.".".$FilesExt;
						}
						else{
							$this->OutPutMessageImages = "Dosya Eklemede Hata Oluştu, Lütfen Bekleyiniz";
						}
					}
				}
			//if(!FileNoDuplicate($data->FileNo))	{

					if($this->FileNoDuplicate($this->FileNo)== 0){


				if($Upload ==1 )
				{


					$data = array(
						"FilesCategoriesID"					=>	DB::CLEAN_DATA($this->FilesCategoriesID),
						"Name"					=>	DB::CLEAN_DATA($this->Name),
						"Files"				=>	DB::CLEAN_DATA($Files),
						"FileNo"				=>	DB::CLEAN_DATA($this->FileNo),
						"PublishDate"			=>	DB::CLEAN_DATA($this->PublishDate),
						"RevisionNo"				=>	DB::CLEAN_DATA($this->RevisionNo),
						"RevisionDate"					=>	DB::CLEAN_DATA($this->RevisionDate),
						"Status"				=>	DB::CLEAN_DATA($this->Status),
						"OrderNo"			=>	DB::CLEAN_DATA($this->OrderNo),
						"ISDELETED"				=>	"0"
					);
					$result = DB::insert("Files", $data);
					if($result > 0)
					{
						$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
					}
					else
					{
						$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
					}
				}else{
					$this->OutPutMessage = ViewReports::Error("Dosya Yüklenemediği için, veritabanına eklenemedi.!!!");
				}
			}else
				$this->OutPutMessage = ViewReports::Error("Aynı isimde Dokuman No olduğundan kayıt edilemedi.!!!");

		}
		public function FilesEdit($ID)
		{
			$this->ID = $ID;

			$Images = '';

			if($_FILES['Files']['name'] != '')
			{
				if($_FILES['Files'])
				{
					$files = $_FILES['Files'];
					$file = new Upload($files, 'tr_TR');



					$Time = time();
					$Random = rand(110, 999999);
					$FilesExt = $file->file_src_name_ext;
					$FilesName = $file->file_new_name_body = $this->Seo($file->file_src_name_body).'_'.$Random;

					$file->allowed = array ( 'application/pdf','application/msword','application/vnd.openxmlformats-officedocument.wordprocessingml.document','application/zip','application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet' );
					$file->Process('../Uploads/Files/');

					if($file->processed)
					{
						$this->OutPutMessageImages = "Dosya Başarıyla Eklendi, Lütfen Bekleyiniz";
						$Upload = 1;

						$Files = $FilesName.".".$FilesExt;
					}
					else{
						$this->OutPutMessageImages = "Dosya Eklemede Hata Oluştu, Lütfen Bekleyiniz";
					}
				}
			}


				$data = array(
					"FilesCategoriesID"					=>	DB::CLEAN_DATA($this->FilesCategoriesID),
					"Name"					=>	DB::CLEAN_DATA($this->Name),
					"Files"				=>	DB::CLEAN_DATA($Files),
					"FileNo"				=>	DB::CLEAN_DATA($this->FileNo),
					"PublishDate"			=>	DB::CLEAN_DATA($this->PublishDate),
					"RevisionNo"				=>	DB::CLEAN_DATA($this->RevisionNo),
					"RevisionDate"					=>	DB::CLEAN_DATA($this->RevisionDate),
					"Status"				=>	DB::CLEAN_DATA($this->Status),
					"OrderNo"			=>	DB::CLEAN_DATA($this->OrderNo),
					"ISDELETED"				=>	"0"
				);

				if($Upload ==1)
				{
					$data['Files'] = $Files;
				}

			$result = DB::update("Files", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("11Hata Oluştu.!!!");
			}
		}
		public function FilesDelete($ID)
		{
			$this->ID = intval($ID);



			$result = $this->connect->prepare("UPDATE Files SET ISDELETED = '1' WHERE ID = ?");
			//$result = $this->connect->prepare("DELETE FROM Files WHERE ID = ?");
			$result = $result->execute(array($ID));

			if($result)
			{
				//unlink("../Uploads/Files/Big/".$lineImages->Images);
				$this->OutPutMessage =  ViewReports::Success("Başarıyla Silindi");
			}
			else
			{
				$this->OutPutMessage =  ViewReports::Error("Hata Oluştu.!!!");
			}
		}

	}

?>
