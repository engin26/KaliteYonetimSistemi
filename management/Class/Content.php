<?php
	class Content extends DB{
		public $ID;
		public $CatID;
		public $SupID;
		public $Name;
		public $Header;
		public $URL;
		public $siraNo;
		public $Content;
		public $Status;
		public $Click;
		public $Time;
		
		public $OutPutMessage;
		
		public function ContentList($CatID, $SupID)
		{
			$result = $this->connect->prepare("SELECT ID, CatID, SupID, Name, Header, URL, siraNo, Content, Status, Click, Time FROM content WHERE ISDELETED = '0' AND CatID = :CatID AND  SupID = :SupID");
			$result->execute(array(':CatID' => $CatID, ':SupID' => $SupID));
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function ContentFindID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT ID, CatID, SupID, Name, Header, URL, siraNo, Content, Status, Click, Time FROM content WHERE ISDELETED = '0' AND ID = ?");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function ContentAdd()
		{
			if($_FILES['Images']['name'] != '')
			{
				if($_FILES['Images'])
				{
					$images = $_FILES['Images'];
					$image = new Upload($images, 'tr_TR');
					$resultResolution = $this->connect->query("SELECT * FROM resolution WHERE TableID = '8'");
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

			$data = array(
				"CatID"		=>	DB::CLEAN_DATA($this->CatID),
				"SupID"		=>	DB::CLEAN_DATA($this->SupID),
				"Name"		=>	DB::CLEAN_DATA($this->Name),
				"Header"	=>	DB::CLEAN_DATA($this->Header),
				"URL"		=>	DB::CLEAN_DATA($this->URL),
				"Images"	=>	$ImagesURL,
				"siraNo"	=>	DB::CLEAN_DATA($this->siraNo),
				"Status"	=>	DB::CLEAN_DATA($this->Status),
				"Content"	=>	DB::SQL_INJECTION($this->Content),
				"CleanContent"	=>	strip_tags($this->Content),
				"Click"		=>	DB::CLEAN_DATA($this->Click),
				"Time"		=>	time(),
				"ISDELETED"	=>	"0"
			);
			
			$result = DB::insert("content", $data);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}

		public function ContentEdit($ID)
		{
			$this->ID = $ID;
			
			if($_FILES['Images']['name'] != '')
			{
				if($_FILES['Images'])
				{
					$images = $_FILES['Images'];
					$image = new Upload($images, 'tr_TR');
					$resultResolution = $this->connect->query("SELECT * FROM resolution WHERE TableID = '8'");
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

					$resultImages = $this->connect->prepare("SELECT Images FROM content WHERE ID = :ID");
					$resultImages->execute(array(":ID"	=>	$this->ID));
					$lineImages = $resultImages->fetch(PDO::FETCH_OBJ);

					print $lineResolution->Path.$lineImages->Images;
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

			if($ImagesExt != '')
			{

				$data = array(
					"Name"		=>	DB::CLEAN_DATA($this->Name),
					"Header"	=>	DB::CLEAN_DATA($this->Header),
					"Content"	=>	DB::SQL_INJECTION($this->Content),
					"CleanContent"	=>	strip_tags($this->Content),
					"Images"	=>	$ImagesURL,
					"URL"		=>	DB::CLEAN_DATA($this->URL),
					"siraNo"	=>	DB::CLEAN_DATA($this->siraNo),
					"Status"	=>	DB::CLEAN_DATA($this->Status),
					"Click"		=>	DB::CLEAN_DATA($this->Click),
					"Time"		=>	time(),
				);
			}
			else
			{
				$data = array(
					"Name"		=>	DB::CLEAN_DATA($this->Name),
					"Header"	=>	DB::CLEAN_DATA($this->Header),
					"Content"	=>	DB::SQL_INJECTION($this->Content),
					"CleanContent"	=>	strip_tags($this->Content),
					"URL"		=>	DB::CLEAN_DATA($this->URL),
					"siraNo"	=>	DB::CLEAN_DATA($this->siraNo),
					"Status"	=>	DB::CLEAN_DATA($this->Status),
					"Click"		=>	DB::CLEAN_DATA($this->Click),
					"Time"		=>	time(),
				);
			}
			$result = DB::update("content", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function ContentDelete($ID)
		{
			$ID = intval($ID);
			
			$result = $this->connect->prepare("UPDATE content SET ISDELETED = '1' WHERE ID = ?");
			//$result = $this->connect->prepare("DELETE FROM Content WHERE ID = ?");
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
			$result = $this->connect->query("SELECT * FROM content WHERE SupID='$katid' AND ISDELETED = '0' ORDER BY siraNo ASC");
												 
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
			$sql = $this->connect->query("SELECT * FROM content WHERE ID='$katid' AND ISDELETED = '0'");
		 
			while($sonuc = $sql->fetch(PDO::FETCH_OBJ))
			{
				$result = $this->connect->query("SELECT SupID FROM content WHERE ISDELETED = '0' AND SupID = '".$sonuc->SupID."'");
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
			global $connect;
			$sql = $this->connect->query("SELECT * FROM content WHERE ISDELETED = '0' AND SupID='$katid'");
		 
			while($sonuc = $sql->fetch(PDO::FETCH_OBJ))
			{
				if(!empty($sonuc))
				{
					$x .=$sonuc->ID.',';
					$x = katListele($sonuc->ID, ($onek+1), $x);
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
		public function katListeleOption($katid, $onek = 1, $x='')
		{
			global $connect;
			$sql = $this->connect->query("SELECT * FROM content WHERE ISDELETED = '0' AND SupID='$katid'");
		 
			while($sonuc = $sql->fetch(PDO::FETCH_OBJ))
			{
				if(!empty($sonuc))
				{
					$ID = $sonuc->ID;
					$x .= '<option>'.$ID.'</option>';
					print $x = katListele($sonuc->ID, ($onek+1), $x);
				}
			}
			return $x;
		}
		function CategoriesWhere($CatID)
		{
			$CatID = intval($CatID);

			$result = $this->connect->query("SELECT * FROM contentcategories WHERE ISDELETED = '0' AND ID='".$CatID."'");
			$line = $result->fetch(PDO::FETCH_OBJ);
			if(@$line->Name != '')
			{
				return $line->Name;
			}
			else
			{
				return "Ana Kategori";
			}
		}	
	}
	
?>