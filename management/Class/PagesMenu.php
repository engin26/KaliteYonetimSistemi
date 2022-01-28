<?php
	class PagesMenu extends PagesCategories{
		public $ID;
		public $CatID;
		public $Name;
		public $SeoName;
		public $Exp;
		public $Header;
		public $Content;
		public $Images;
		public $siraNo;
		public $Description;
		public $Keywords;
		public $Time;
		
		public $OutPutMessage;
		
		public function PagesMenuList($CatID)
		{
			$this->CatID = $CatID;
			
			$result = $this->connect->prepare("SELECT ID, CatID, Name, SeoName, Header, Exp, Content, Images, siraNo, Description, Keywords, Time FROM PagesMenu WHERE ISDELETED = '0' AND CatID = ?");
			$result->execute(array($this->CatID));
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function PagesMenuFindID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT ID, CatID, Name, SeoName, Header, Exp, Content, Images, siraNo, Description, Keywords, Time FROM PagesMenu WHERE ISDELETED = '0' AND ID = ?");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function PagesMenuAdd()
		{
			
				
				if($_FILES['Images']['name'] != '')
				{
					if($_FILES['Images'])
					{
						$images = $_FILES['Images'];
						$image = new Upload($images, 'tr_TR');
						
						$resultResolution = $this->connect->query("SELECT * FROM Resolution WHERE TableID = '1'");
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
						$image->Process('../Uploads/PagesMenu/Big');
						
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
				$data = array(
					"CatID"			=>	DB::CLEAN_DATA($this->CatID),
					"Name"			=>	DB::CLEAN_DATA($this->Name),
					"SeoName"		=>	Library::Seo($this->Name),
					"Header"		=>	DB::CLEAN_DATA($this->Header),
					"Exp"			=>	DB::CLEAN_DATA($this->Exp),
					"Content"		=>	DB::SQL_INJECTION($this->Content),
					"Images"		=>	$ImagesName.".".$ImagesExt,
					"siraNo"		=>	DB::CLEAN_DATA($this->siraNo),
					"Description"	=>	DB::CLEAN_DATA($this->Description),
					"Keywords"		=>	DB::CLEAN_DATA($this->Keywords),
					"Time"			=>	time(),
					"ISDELETED"		=>	"0"
				);
				$result = DB::insert("PagesMenu", $data);
				if($result > 0)
				{
					$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
				}
				else
				{
					$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
				}
			
		}
		public function PagesMenuEdit($ID)
		{
			$this->ID = $ID;
			
			
			if($_FILES['Images']['name'] != '')
				{
					
					if($_FILES['Images'])
					{
						$images = $_FILES['Images'];
						$image = new Upload($images, 'tr_TR');
						
						$resultResolution = $this->connect->query("SELECT * FROM Resolution WHERE TableID = '1'");
						$lineResolution = $resultResolution->fetch(PDO::FETCH_OBJ);
						
						$resultImages = $this->connect->prepare("SELECT Images FROM PagesMenu WHERE ID = ?");
						$resultImages->execute(array($this->ID));
						$lineImages = $resultImages->fetch(PDO::FETCH_OBJ);
						unlink("../Uploads/PagesMenu/Big/".$lineImages->Images);

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
						$image->Process('../Uploads/PagesMenu/Big');
						
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
				
			if($_FILES['Images']['name'] != '')
			{
				$data = array(
						"Name"			=>	DB::CLEAN_DATA($this->Name),
						"SeoName"		=>	Library::Seo($this->Name),
						"Header"		=>	DB::CLEAN_DATA($this->Header),
						"Exp"			=>	DB::CLEAN_DATA($this->Exp),
						"Content"		=>	DB::SQL_INJECTION($this->Content),
						"Images"		=>	$ImagesName.".".$ImagesExt,
						"siraNo"		=>	DB::CLEAN_DATA($this->siraNo),
						"Description"	=>	DB::CLEAN_DATA($this->Description),
						"Keywords"		=>	DB::CLEAN_DATA($this->Keywords),
						"Time"			=>	time()
				);
			}
			else
			{
				$data = array(
						"Name"			=>	DB::CLEAN_DATA($this->Name),
						"SeoName"		=>	Library::Seo($this->Name),
						"Header"		=>	DB::CLEAN_DATA($this->Header),
						"Exp"			=>	DB::CLEAN_DATA($this->Exp),
						"Content"		=>	DB::SQL_INJECTION($this->Content),
						"siraNo"		=>	DB::CLEAN_DATA($this->siraNo),
						"Description"	=>	DB::CLEAN_DATA($this->Description),
						"Keywords"		=>	DB::CLEAN_DATA($this->Keywords),
						"Time"			=>	time()
				);
			}
			$result = DB::update("PagesMenu", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function PagesMenuDelete($ID)
		{
			$ID = intval($ID);
			
			$result = $this->connect->prepare("UPDATE PagesMenu SET ISDELETED = '1' WHERE ID = ?");
			//$result = $this->connect->prepare("DELETE FROM PagesMenu WHERE ID = ?");
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
		
	}
	
?>