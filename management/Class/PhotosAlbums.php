<?php
	class PhotosAlbums extends DB{
		public $ID;
		public $PhotosAlbumsID;
		public $Images;
		public $Name;
		
		
		public $OutPutMessage;
		public $OutPutMessageCover;
		
		public function PhotosAlbumsList()
		{
			$result = $this->connect->query("SELECT ID, Name, SeoName FROM PhotosAlbums WHERE ISDELETED = '0'");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function PhotosAlbumsGalleryList()
		{
			$result = $this->connect->query("SELECT ID, Name, Images, Cover FROM PhotosAlbumsGallery WHERE PhotosAlbumsID = '".$this->PhotosAlbumsID."' AND ISDELETED = '0'");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function PhotosAlbumsFindID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT ID, Name, SeoName  FROM PhotosAlbums WHERE ISDELETED = '0' AND ID = ?");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function PhotosAlbumsAdd()
		{
			$data = array(
				"Name"		=>	DB::CLEAN_DATA($this->Name),
				"SeoName"	=>	Library::Seo($this->Name),
				"ISDELETED"	=>	"0"
			);
			
			$result = DB::insert("PhotosAlbums", $data);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function PhotosAlbumsEdit($ID)
		{
			$this->ID = $ID;
			
			$data = array(
				"Name"		=>	DB::CLEAN_DATA($this->Name),
				"SeoName"	=>	Library::Seo($this->Name),
			);
			
			$result = DB::update("PhotosAlbums", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function PhotosAlbumsGalleryCover($PhotosAlbumsID, $ID)
		{
			$this->ID = $ID;
			$this->PhotosAlbumsID = $PhotosAlbumsID;
			
			$data = array(
				"Cover"		=>	"0",
			);
			
			$result = DB::update("PhotosAlbumsGallery", $data, "PhotosAlbumsID = ".$this->PhotosAlbumsID);

			$data = array(
				"Cover"		=>	"1",	
			);
			
			$result = DB::update("PhotosAlbumsGallery", $data, "ID = ".$this->ID);

			if($result > 0)
			{
				$this->OutPutMessageCover = ViewReports::Success("Kapak Resmi Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessageCover = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function PhotosAlbumsDelete($ID)
		{
			$ID = intval($ID);
			
			//$result = $this->connect->prepare("DELETE FROM MainMenuCategories WHERE ID = ?");
			$result = $this->connect->prepare("UPDATE PhotosAlbums SET ISDELETED = '1' WHERE ID = ?");
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

		public function PhotosAlbumsGalleryAdd()
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
						

						$resultResolution = $this->connect->query("SELECT * FROM Resolution WHERE TableID = '7'");
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
						$image->Process('../Uploads/PhotosAlbumsGallery/Big/');

						if($image->processed) 
						{
							$this->OutPutMessageImages = "Resim Başarıyla Eklendi, Lütfen Bekleyiniz";
							$Upload = 1;
						}
						else{
							$this->OutPutMessageImages = "Resim Eklemede Hata Oluştu, Lütfen Bekleyiniz";
						}
					
				
					$data = array(
						"PhotosAlbumsID"	=>	DB::CLEAN_DATA($this->PhotosAlbumsID),
						"Name"				=>	DB::CLEAN_DATA($this->Name),
						"Images"			=>	$ImagesName.".".$ImagesExt,
						"ISDELETED"			=>	"0"
					);
					$result = DB::insert("PhotosAlbumsGallery", $data);
					if($result > 0)
					{
						$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
					}
					else
					{
						$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
					}
				}
		}

	}
	
?>