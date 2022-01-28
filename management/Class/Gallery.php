<?php
	class Gallery extends DB{
		public $ID;
		public $GalleryMainMenuID;
		public $GalleryCategoriesID;
		public $ReferencesID;
		public $Name;
		public $EmbedCode;
		public $Link;
		public $Target;
		public $Images;
		public $Cover;
		public $siraNo;
		public $Time;
		public $ISDELETED;
		
		public $OutPutMessage;
		public $OutPutMessageImages;
		
		public function GalleryMainMenuList()
		{
			if($this->GalleryMainMenuID == 0)
			{
				$sql = "SELECT ID, Name FROM gallerymainmenu WHERE  ISDELETED = '0'";
			}
			else
			{
				$sql = "SELECT ID, Name FROM gallerymainmenu WHERE ID = '".$this->GalleryMainMenuID."' AND Status = '1' AND  ISDELETED = '0'";
			}

			$result = $this->connect->query($sql);
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}

		public function GalleryCategoriesList()
		{
			$result = $this->connect->prepare("SELECT ID, GalleryMainMenuID, Name FROM gallerycategories WHERE GalleryMainMenuID = ? AND  Status = '1' AND ISDELETED = '0'");
			$result->execute(array($this->GalleryMainMenuID));
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		
		public function GalleryList()
		{
			$result = $this->connect->prepare("SELECT * FROM gallery WHERE GalleryCategoriesID = ? AND ISDELETED = '0'");
			$result->execute(array($this->GalleryCategoriesID));

			$line = $result->fetchAll(PDO::FETCH_OBJ);
			return $line;
		}
		
		public function GalleryFindID()
		{
			$result = $this->connect->prepare("SELECT * FROM gallery WHERE ID = ? AND ISDELETED = '0'");
			$result->execute(array($this->ID));

			$line = $result->fetch(PDO::FETCH_OBJ);
			//print_r($line);
			return $line;
		}
		

		public function Resolution()
		{
						
			$result = $this->connect->prepare("SELECT ID, GalleryCategoriesID, Path, BigWidth, BigHeight, BigQuality FROM gallerycategoriessettings WHERE ID = :ID");
			$result->execute(array(":ID"	=>	$this->GalleryCategoriesID));

			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}

		public function GalleryCover($GalleryCategoriesID, $ID)
		{
			$this->ID = $ID;
			$this->GalleryCategoriesID = $GalleryCategoriesID;
			
			$data = array(
				"Cover"		=>	"0",
			);
			
			$result = DB::update("gallery", $data, "GalleryCategoriesID = ".$this->GalleryCategoriesID);

			$data = array(
				"Cover"		=>	"1",	
			);
			
			$result = DB::update("gallery", $data, "ID = ".$this->ID);

			if($result > 0)
			{
				$this->OutPutMessageCover = ViewReports::Success("Kapak Resmi Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessageCover = ViewReports::Error("Hata Oluştu.!!!");
			}
		}

		public function GalleryAdd()
		{
			$resimler = array();

			if($_FILES['Images'] == '')
			{
				print "<div class='alert alert-danger'>Lütfen Resim Seçiniz.</div>";

				exit();
			}
			foreach ($_FILES['Images'] as $k => $l) {
			  foreach ($l as $i => $v) {
			   if (!array_key_exists($i, $resimler))
				 $resimler[$i] = array();
			   $resimler[$i][$k] = $v;
			  }
			}

			foreach ($resimler as $resim)
			{
				$image = new Upload($resim, 'tr_TR');
				
				$resultResolution = $this->connect->query("SELECT * FROM gallerycategoriessettings WHERE GalleryCategoriesID = '".$this->GalleryCategoriesID."'");
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
				else
				{
					$this->OutPutMessageImages = "Resim Eklemede Hata Oluştu, Lütfen Bekleyiniz";
					 print 'Bir sorun oluştu: ' . $image->error;
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
					"GalleryCategoriesID"	=>	DB::CLEAN_DATA($this->GalleryCategoriesID),
					"ReferencesID"			=>	DB::CLEAN_DATA($this->ReferencesID),
					"Name"					=>	$this->Name,
					"EmbedCode"				=>	$this->EmbedCode,
					"Link"					=>	$this->Link,
					"Target"				=>	$this->Target,
					"Images"				=>	$ImagesURL,
					"Cover"					=>	$this->Cover,
					"siraNo"				=>	DB::CLEAN_DATA($this->siraNo),
					"Time"					=>	$this->Time,
					"ISDELETED"				=>	"0"
				);
				$result = DB::insert("gallery", $data);

				if($result > 0)
				{
					$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
				}
				else
				{
					$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
					 print 'Bir sorun oluştu: ' . $image->error;
				}
			}
		}

		public function GalleryEdit()
		{
			$resimler = array();

			if($_FILES['Images'] == '')
			{
				print "<div class='alert alert-danger'>Lütfen Resim Seçiniz.</div>";

				exit();
			}
			foreach ($_FILES['Images'] as $k => $l) {
			  foreach ($l as $i => $v) {
			   if (!array_key_exists($i, $resimler))
				 $resimler[$i] = array();
			   $resimler[$i][$k] = $v;
			  }
			}

			foreach ($resimler as $resim)
			{
				$image = new Upload($resim, 'tr_TR');
				
				$resultResolution = $this->connect->query("SELECT * FROM gallerycategoriessettings WHERE GalleryCategoriesID = '".$this->GalleryCategoriesID."'");
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
				else
				{
					$this->OutPutMessageImages = "Resim Eklemede Hata Oluştu, Lütfen Bekleyiniz";
					 print 'Bir sorun oluştu: ' . $image->error;
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
					"GalleryCategoriesID"	=>	DB::CLEAN_DATA($this->GalleryCategoriesID),
					"ReferencesID"			=>	DB::CLEAN_DATA($this->ReferencesID),
					"Name"					=>	$this->Name,
					"EmbedCode"				=>	$this->EmbedCode,
					"Link"					=>	$this->Link,
					"Target"				=>	$this->Target,
					"Images"				=>	$ImagesURL,
					"Cover"					=>	$this->Cover,
					"siraNo"				=>	DB::CLEAN_DATA($this->siraNo),
					"Time"					=>	$this->Time,
					"ISDELETED"				=>	"0"
				);

				$result = DB::update("gallery", $data, "ID = ".$this->ID);

				if($result)
				{
					$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
				}
				else
				{
					$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
					 print 'Bir sorun oluştu: ' . $image->error;
				}
			}
		}
		
		
		public function GalleryDelete($ID)
		{			
			
		}
		
	}
	
?>