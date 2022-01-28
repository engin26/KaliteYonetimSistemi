<?php
	class Legislation extends DB{
		public $ID;
		public $CatID;
		public $SupID;
		public $Name;
		public $Header;
		public $DateTime;
		public $Number;
		public $Images;
		public $Files;
		public $siraNo;
		public $Content;
		public $Status;
		public $Click;
		public $Time;
		
		public $FilesURL;

		public $OutPutMessage;
		public $OutPutMessageImages;
		public $OutPutMessageFiles;
		
		public function LegislationList()
		{
			$result = $this->connect->prepare("SELECT ID, CatID, SupID, Name, Header, DateTime, Number, Images, Files, URL, siraNo, Content, Status, Click, Time FROM Legislation WHERE ISDELETED = '0'");
			$result->execute(array(':CatID' => $CatID, ':SupID' => $SupID));
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function LegislationFindID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT ID, CatID, SupID, Name, Header, DateTime, Number, Images, Files, URL, siraNo, Content, Status, Click, Time FROM Legislation WHERE ISDELETED = '0' AND ID = ?");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function LegislationAdd()
		{
			if($_FILES['Images']['name'] != '')
			{
				if($_FILES['Images'])
				{
					$images = $_FILES['Images'];
					$image = new Upload($images, 'tr_TR');
					$resultResolution = $this->connect->query("SELECT * FROM Resolution WHERE TableID = '8'");
					$lineResolution = $resultResolution->fetch(PDO::FETCH_OBJ);
						
					$Random = rand(110, 999999);
					/* Yüklenen Resim Boyutları */
					$Width = $image->image_src_x;
					$Height = $image->image_src_y;
						
					$ImagesExt = $image->file_src_name_ext;
					/* Büyük Resim Ayarları */
					if($lineResolution->BigWidth == 'auto') $DefaultBigWidth = $Width; else $DefaultBigWidth = $lineResolution->BigWidth;
									
					$DefaultBigHeight = ceil(($Height * $DefaultBigWidth) / $Width);
								
					if($lineResolution->BigHeight != 'auto') $DefaultBigHeight = $lineResolution->BigHeight;
						
						
					$Time = time();
					// Büyük Resim İçin
					$ImagesName = $image->file_new_name_body = $Time.'_'.$Random;
					$image->image_resize = true;
					$image->image_ratio_crop = true;
					$image->image_x = $DefaultBigWidth;
					$image->image_y = $DefaultBigHeight;
					if($lineResolution->FiligramName != '')
					{
						$image->image_text = $lineResolution->FiligramName;
					}
					if($lineResolution->FiligramColor != '')
					{
						$image->image_text_color =  $lineResolution->FiligramColor;
					}
					else
					{
						$image->image_text_color =  '#000';
					}
					if($lineResolution->Position != '')
					{
						$image->image_text_position =  $lineResolution->Position;
					}
					else
					{
						$image->image_text_position =  'BR';
					}
					$handle->image_text_font = 4;
					$image->jpeg_quality = $lineResolution->BigQuality;
					$image->png_compression = 9;
									
					$image->allowed = array ( 'image/*' );
					$image->Process($lineResolution->Path);
					
					if($image->processed) 
					{
						$this->OutPutMessageImages = "Resim Başarıyla Eklendi, Lütfen Bekleyiniz";
						$Upload = 1;
					}
					else{
						$this->OutPutMessageImages = "Resim Eklemede Hata Oluştu, Lütfen Bekleyiniz";
					}
				}
			}
			if($ImagesExt != '')
			{
				$ImagesURL = $ImagesName.".".$ImagesExt;
			}
			else
			{
				$ImagesURL = "";
			}

			/* PDF YÜKLE */

			$this->UploadPDF();
			

			$data = array(
				"CatID"		=>	DB::CLEAN_DATA($this->CatID),
				"SupID"		=>	DB::CLEAN_DATA($this->SupID),
				"Name"		=>	DB::CLEAN_DATA($this->Name),
				"Header"	=>	DB::CLEAN_DATA($this->Header),
				"DateTime"	=>	DB::CLEAN_DATA($this->DateTime),
				"Number"	=>	DB::CLEAN_DATA($this->Number),
				"Images"	=>	$ImagesURL,
				"Files"		=>	$this->FilesURL,
				"URL"		=>	DB::CLEAN_DATA($this->URL),
				"siraNo"	=>	DB::CLEAN_DATA($this->siraNo),
				"Content"	=>	DB::SQL_INJECTION($this->Content),
				"Status"	=>	DB::CLEAN_DATA($this->Status),
				"Click"		=>	DB::CLEAN_DATA($this->Click),
				"Time"		=>	time(),
				"ISDELETED"	=>	"0"
			);
			
			$result = DB::insert("Legislation", $data);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!"); exit();
			}
		}

		public function LegislationEdit($ID)
		{
			$this->ID = $ID;
			
			if($_FILES['Images']['name'] != '')
			{
				if($_FILES['Images'])
				{
					$images = $_FILES['Images'];
					$image = new Upload($images, 'tr_TR');
					$resultResolution = $this->connect->query("SELECT * FROM Resolution WHERE TableID = '8'");
					$lineResolution = $resultResolution->fetch(PDO::FETCH_OBJ);
					
					$Random = rand(110, 999999);
					/* Yüklenen Resim Boyutları */
					$Width = $image->image_src_x;
					$Height = $image->image_src_y;
						
					$ImagesExt = $image->file_src_name_ext;
					/* Büyük Resim Ayarları */
					if($lineResolution->BigWidth == 'auto') $DefaultBigWidth = $Width; else $DefaultBigWidth = $lineResolution->BigWidth;
									
					$DefaultBigHeight = ceil(($Height * $DefaultBigWidth) / $Width);
								
					if($lineResolution->BigHeight != 'auto') $DefaultBigHeight = $lineResolution->BigHeight;
						
						
					$Time = time();
					// Büyük Resim İçin

					$resultImages = $this->connect->prepare("SELECT Images FROM Legislation WHERE ID = :ID");
					$resultImages->execute(array(":ID"	=>	$this->ID));
					$lineImages = $resultImages->fetch(PDO::FETCH_OBJ);

					//print $lineResolution->Path.$lineImages->Images;
					unlink($lineResolution->Path.$lineImages->Images);

					$ImagesName = $image->file_new_name_body = $Time.'_'.$Random;
					$image->image_resize = true;
					$image->image_ratio_crop = true;
					$image->image_x = $DefaultBigWidth;
					$image->image_y = $DefaultBigHeight;
					if($lineResolution->FiligramName != '')
					{
						$image->image_text = $lineResolution->FiligramName;
					}
					if($lineResolution->FiligramColor != '')
					{
						$image->image_text_color =  $lineResolution->FiligramColor;
					}
					else
					{
						$image->image_text_color =  '#000';
					}
					if($lineResolution->Position != '')
					{
						$image->image_text_position =  $lineResolution->Position;
					}
					else
					{
						$image->image_text_position =  'BR';
					}
					$handle->image_text_font = 4;
					$image->jpeg_quality = $lineResolution->BigQuality;
					$image->png_compression = 9;
									
					$image->allowed = array ( 'image/*' );
					$image->Process($lineResolution->Path);
					
					if($image->processed) 
					{
						$this->OutPutMessageImages = "Resim Başarıyla Eklendi, Lütfen Bekleyiniz";
						$Upload = 1;
					}
					else{
						$this->OutPutMessageImages = "Resim Eklemede Hata Oluştu, Lütfen Bekleyiniz";
					}
				}
			}
			if($ImagesExt != '')
			{
				$ImagesURL = $ImagesName.".".$ImagesExt;
			}
			else
			{
				$ImagesURL = "";
			}

			$this->UploadPDF();

			

			$data = array(
					"Name"		=>	DB::CLEAN_DATA($this->Name),
					"Header"	=>	DB::CLEAN_DATA($this->Header),
					"DateTime"	=>	DB::CLEAN_DATA($this->DateTime),
					"Number"	=>	DB::CLEAN_DATA($this->Number),
					"URL"		=>	DB::CLEAN_DATA($this->URL),
					"siraNo"	=>	DB::CLEAN_DATA($this->siraNo),
					"Content"	=>	DB::SQL_INJECTION($this->Content),
					"Status"	=>	DB::CLEAN_DATA($this->Status),
					"Time"		=>	time(),
			);

			if($ImagesURL != '')
			{
				$data['Images'] = $ImagesURL;
			}

			if($this->FilesURL != '')
			{
				$data['Files'] = $this->FilesURL;
			}

			$result = DB::update("Legislation", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function LegislationDelete($ID)
		{
			$ID = intval($ID);
			
			$result = $this->connect->prepare("UPDATE Legislation SET ISDELETED = '1' WHERE ID = ?");
			//$result = $this->connect->prepare("DELETE FROM Legislation WHERE ID = ?");
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
		public function CreateCategoriesSelect($katid, $onek = 1, $x='')
		{
			$result = $this->connect->query("SELECT * FROM LegislationCategories WHERE SupID='$katid' AND ISDELETED = '0' ORDER BY siraNo ASC");
												 
			while($sonuc = $result->fetch(PDO::FETCH_OBJ))
			{
				if(!empty($sonuc))
				{
					$x = $x.str_repeat('#', $onek).$sonuc->ID.'&';
					$x = $this->CreateCategoriesSelect($sonuc->ID, ($onek+1), $x);
				}
			}
			return $x;
		}
		public function ReverseKatListele($katid, $onek = 1, $x='')
		{
			global $connect;
			$sql = $this->connect->query("SELECT * FROM LegislationCategories WHERE ID='$katid' AND ISDELETED = '0'");
		 
			while($sonuc = $sql->fetch(PDO::FETCH_OBJ))
			{
				$result = $this->connect->query("SELECT SupID FROM LegislationCategories WHERE ISDELETED = '0' AND SupID = '".$sonuc->SupID."'");
				$line = $result->fetch(PDO::FETCH_OBJ);
				if(!empty($sonuc))
				{
					$x .=$sonuc->ID.',';
					$x = $this->ReverseKatListele($line->SupID, ($onek+1), $x);
				}
			}
			return $x;
		}
		public function GetReverseCategoriesListAll($ID)
		{
			$ProID = $this->ReverseKatListele($ID);
			$ProID = substr($ProID, 0,-1);
			if(!empty($ProID))
			{
				return $ProID.=','.$ID;
			}
			else
			{
				return $ProID = $ID;
			}
		}
		public function katListele($katid, $onek = 1, $x='')
		{
			$sql = $this->connect->query("SELECT * FROM LegislationCategories WHERE ISDELETED = '0'");
		 
			while($sonuc = $sql->fetch(PDO::FETCH_OBJ))
			{
				if(!empty($sonuc))
				{
					$x .=$sonuc->ID.',';
					$x = $this->katListele($sonuc->ID, ($onek+1), $x);
				}
			}
			return $x;
		}
		public function GetCategoriesListAll($ID){
			$ProID = katListele($ID);
			$ProID = substr($ProID, 0,-1);
			if(!empty($ProID))
			{
				return $ProID.=','.$ID;
			}
			else
			{
				return $ProID = $ID;
			}
		}
		public function katListeleOption($onek = 1, $x='')
		{
			
			$sql = $this->connect->query("SELECT * FROM LegislationCategories WHERE ISDELETED = '0'");
		 
			while($sonuc = $sql->fetch(PDO::FETCH_OBJ))
			{
				if(!empty($sonuc))
				{
					
					$x .= '<option value="'.$sonuc->ID.'">'.$sonuc->Name.'</option>';
					
				}
			}
			return $x;
		}
		function CategoriesWhere($SupID)
		{
			$SupID = intval($SupID);
			$result = $this->connect->query("SELECT * FROM LegislationCategories WHERE ISDELETED = '0' AND ID='".$SupID."'");
			$line = $result->fetch(PDO::FETCH_OBJ);
			if(@$line->Name != '')
			{
				return "<a href='Profile.php?func=Legislation&ID=".$line->SupID."'>".$line->Name."</a>";
			}
			else
			{
				return "Ana Kategori";
			}
		}
		public function UploadPDF()
		{
			if($_FILES['Files']['name'] != '')
			{
				$Files = explode(".", $_FILES['Files']['name']);

				$FilesExt = end(explode(".", $_FILES['Files']['name']));

				$this->FilesURL = 'file-'.microtime(true).'.'.$FilesExt;

				if($FilesExt == 'pdf' || $FilesExt == 'PDF')
				{
					if(move_uploaded_file($_FILES['Files']['tmp_name'], '../Uploads/Legislation/'.$this->FilesURL))
					{
						$this->OutPutMessageFiles = ViewReports::Success("Dosya Başarıyla Eklendi");
					}
					else
					{
						$this->OutPutMessageFiles = ViewReports::Error("Dosya Eklemede Hata oluştu");
					}
				}
			}
		}
	}
	
?>