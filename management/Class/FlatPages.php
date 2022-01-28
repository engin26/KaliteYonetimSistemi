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
		
		public function FilesList()
		{			
			
			$result = $this->connect->prepare("SELECT * FROM Files WHERE ISDELETED = '0'");
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
				$Images = '';
				if($_FILES['Images']['name'] != '')
				{
					if($_FILES['Images'])
					{
						$images = $_FILES['Images'];
						$image = new Upload($images, 'tr_TR');
						
						$resultResolution = $this->connect->query("SELECT * FROM resolution WHERE TableID = '4'");
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
						$image->Process('../Uploads/Files/Big');
						
						if($image->processed) 
						{
							$this->OutPutMessageImages = "Resim Başarıyla Eklendi, Lütfen Bekleyiniz";
							$Upload = 1;
							
							$Images = $ImagesName.".".$ImagesExt;
						}
						else{
							$this->OutPutMessageImages = "Resim Eklemede Hata Oluştu, Lütfen Bekleyiniz";
						}
					}
				}
				$data = array(
					"Name"					=>	DB::CLEAN_DATA($this->Name),
					"Header"				=>	DB::CLEAN_DATA($this->Header),
					"SeoName"				=>	Library::Seo($this->Name),
					"ShortContent"			=>	DB::CLEAN_DATA($this->ShortContent),
					"Link"					=>	DB::CLEAN_DATA($this->Link),
					"Content"				=>	DB::SQL_INJECTION($this->Content),
					"Images"				=>	$Images,
					"Description"			=>	DB::CLEAN_DATA($this->Description),
					"Keywords"				=>	DB::CLEAN_DATA($this->Keywords),
					"Time"					=>	time(),
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
			
		}
		public function FilesEdit($ID)
		{
			$this->ID = $ID;
			
			$Images = '';
			
			if($_FILES['Images']['name'] != '')
				{
					
					if($_FILES['Images'])
					{
						$images = $_FILES['Images'];
						$image = new Upload($images, 'tr_TR');
						
						$resultResolution = $this->connect->query("SELECT * FROM resolution WHERE TableID = '4'");
						$lineResolution = $resultResolution->fetch(PDO::FETCH_OBJ);
						
						$resultImages = $this->connect->prepare("SELECT Images FROM Files WHERE ID = ?");
						$resultImages->execute(array($this->ID));
						$lineImages = $resultImages->fetch(PDO::FETCH_OBJ);
						unlink("../Uploads/Files/Big/".$lineImages->Images);

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
						$ImagesName 	= $image->file_new_name_body = $Time.'_'.$Random;

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
						$image->Process('../Uploads/Files/Big');
						
						if($image->processed) 
						{
							$this->OutPutMessageImages = "Resim Başarıyla Eklendi, Lütfen Bekleyiniz";
							$Upload = 1;
							
							$Images = $ImagesName.".".$ImagesExt;
						}
						else{
							$this->OutPutMessageImages = "Resim Eklemede Hata Oluştu, Lütfen Bekleyiniz";
						}
					}
				}
				
			
				$data = array(
					"Name"					=>	DB::CLEAN_DATA($this->Name),
					"Header"				=>	DB::CLEAN_DATA($this->Header),
					"SeoName"				=>	Library::Seo($this->Name),
					"ShortContent"			=>	DB::CLEAN_DATA($this->ShortContent),
					"Link"					=>	DB::CLEAN_DATA($this->Link),
					"Content"				=>	DB::SQL_INJECTION($this->Content),
					
					"Description"			=>	DB::CLEAN_DATA($this->Description),
					"Keywords"				=>	DB::CLEAN_DATA($this->Keywords),
					"Time"					=>	time(),
				);
				
				if($Images != '')
				{
					$data['Images'] = $Images;
				}
			
			$result = DB::update("Files", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function FilesDelete($ID)
		{			
			$this->ID = intval($ID);
			
			$resultImages = $this->connect->prepare("SELECT Images FROM Files WHERE ID = ?");
			$resultImages->execute(array($this->ID));
			$lineImages = $resultImages->fetch(PDO::FETCH_OBJ);
			
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