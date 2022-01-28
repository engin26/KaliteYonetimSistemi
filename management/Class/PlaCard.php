<?php
	class PlaCard extends DB{
		public $ID;
		public $PlaCardCategoriesID;
		public $Name;
		public $ShortContent;
		public $Images;
		public $Link;
		public $Target;
		public $Time;
		
		public $OutPutMessage;
		public $OutPutMessageImages;
		
		public function PlaCardList()
		{
			
			$result = $this->connect->query("SELECT * FROM PlaCard WHERE ISDELETED = '0' ORDER BY ID DESC");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function PlaCardFindID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT * FROM PlaCard WHERE ISDELETED = '0' AND ID = ?");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function PlaCardAdd()
		{
				$Images = '';
				if($_FILES['Images']['name'] != '')
				{
					if($_FILES['Images'])
					{
						$images = $_FILES['Images'];
						$image = new Upload($images, 'tr_TR');
						
						$resultResolution = $this->connect->query("SELECT * FROM Resolution WHERE TableID = '6'");
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
						$image->Process('../Uploads/PlaCard/Big');
						
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
					"PlaCardCategoriesID"	=>	"1",
					"Name"					=>	DB::CLEAN_DATA($this->Name),
					"ShortContent"			=>	DB::CLEAN_DATA($this->ShortContent),
					"Images"				=>	$Images,
					"Link"					=>	DB::CLEAN_DATA($this->Link),
					"Target"				=>	DB::CLEAN_DATA($this->Target),
					"Time"					=>	time(),
					"ISDELETED"				=>	"0"
				);
				$result = DB::insert("PlaCard", $data);
				if($result > 0)
				{
					$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
				}
				else
				{
					$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
				}
			
		}
		public function PlaCardEdit($ID)
		{
			$this->ID = $ID;
			
			$Images = '';
			
			if($_FILES['Images']['name'] != '')
				{
					
					if($_FILES['Images'])
					{
						$images = $_FILES['Images'];
						$image = new Upload($images, 'tr_TR');
						
						$resultResolution = $this->connect->query("SELECT * FROM Resolution WHERE TableID = '6'");
						$lineResolution = $resultResolution->fetch(PDO::FETCH_OBJ);
						
						$resultImages = $this->connect->prepare("SELECT Images FROM PlaCard WHERE ID = ?");
						$resultImages->execute(array($this->ID));
						$lineImages = $resultImages->fetch(PDO::FETCH_OBJ);
						unlink("../Uploads/PlaCard/Big/".$lineImages->Images);

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
						$image->Process('../Uploads/PlaCard/Big');
						
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
					"PlaCardCategoriesID"	=>	"1",
					"Name"					=>	DB::CLEAN_DATA($this->Name),
					"ShortContent"			=>	DB::CLEAN_DATA($this->ShortContent),
					"Images"				=>	$Images,
					"Link"					=>	DB::CLEAN_DATA($this->Link),
					"Target"				=>	DB::CLEAN_DATA($this->Target),
					"Time"					=>	time()
				);
			
			$result = DB::update("PlaCard", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function PlaCardDelete($ID)
		{			
			$this->ID = intval($ID);
			
			/*$resultImages = $this->connect->prepare("SELECT Images FROM PlaCard WHERE ID = ?");
			$resultImages->execute(array($this->ID));
			$lineImages = $resultImages->fetch(PDO::FETCH_OBJ);
			
			$result = $this->connect->prepare("DELETE FROM PlaCard WHERE ID = ?"); */
			$result = $this->connect->prepare("UPDATE PlaCard  SET  ISDELETED = '1' WHERE ID = ?");

			$result = $result->execute(array($ID));
			
			if($result)
			{
				//unlink("../Uploads/PlaCard/Big/".$lineImages->Images);
				
				$this->OutPutMessage =  ViewReports::Success("Başarıyla Silindi");
			}
			else
			{
				$this->OutPutMessage =  ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		
	}
	
?>