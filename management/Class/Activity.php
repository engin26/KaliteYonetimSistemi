<?php
	class Activity extends DB{
		public $ID;
		public $ActivityCategoriesID;
		public $Header;
		public $SeoName;
		public $ShortContent;
		public $Content;
		public $Images;
		public $Link;
		public $Click;
		public $Tags;
		public $TimeSort;
		public $Time;
		
		public $OutPutMessage;
		public $OutPutMessageImages;
		
		public function ActivityList($ActivityCategoriesID)
		{
			$this->ActivityCategoriesID = $ActivityCategoriesID;
			
			if($this->ActivityCategoriesID == 0)
			{
				$result = $this->connect->prepare("SELECT ActivityCategories.ID AS CatID, ActivityCategories.Name, Activity.ID, Activity.ActivityCategoriesID, Activity.Header, Activity.SeoName, Activity.ShortContent, Activity.Content, Activity.Images, Activity.Link, Activity.Click, Activity.Tags, Activity.TimeSort, Activity.Time FROM ActivityCategories INNER JOIN Activity ON ActivityCategories.ID = Activity.ActivityCategoriesID WHERE Activity.ISDELETED = '0' ORDER BY Activity.siraNo ASC");
				$result->execute();
			}
			else
			{
				$result = $this->connect->prepare("SELECT ActivityCategories.ID AS CatID, ActivityCategories.Name, Activity.ID, Activity.ActivityCategoriesID, Activity.Header, Activity.SeoName, Activity.ShortContent, Activity.Content, Activity.Images, Activity.Link, Activity.Click, Activity.Tags, Activity.Description, Activity.Keywords, Activity.TimeSort, Activity.Time FROM ActivityCategories INNER JOIN Activity ON ActivityCategories.ID = Activity.ActivityCategoriesID WHERE  ActivityCategories.ID = ? AND Activity.ISDELETED = '0' ORDER BY Activity.siraNo ASC");
				$result->execute(array($this->CatID));
			}
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function ActivityFindID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT ActivityCategories.ID AS CatID, ActivityCategories.Name, Activity.ID, Activity.ActivityCategoriesID, Activity.Header, Activity.SeoName, Activity.ShortContent, Activity.Content, Activity.Images, Activity.Link, Activity.Click, Activity.Tags, Activity.Description, Activity.Keywords, Activity.TimeSort, Activity.Time FROM ActivityCategories INNER JOIN Activity ON ActivityCategories.ID = Activity.ActivityCategoriesID WHERE Activity.ID = ? AND Activity.ISDELETED = '0' ORDER BY Activity.siraNo ASC");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function ActivityAdd()
		{
				if($_FILES['Images']['name'] != '')
				{
					if($_FILES['Images'])
					{
						$images = $_FILES['Images'];
						$image = new Upload($images, 'tr_TR');
						$resultResolution = $this->connect->query("SELECT * FROM Resolution WHERE TableID = '3'");
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
						$image->Process('../Uploads/Activity/Big');
						
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
					"ActivityCategoriesID"	=>	DB::CLEAN_DATA($this->ActivityCategoriesID),
					"Header"				=>	DB::CLEAN_DATA($this->Header),
					"SeoName"				=>	DB::CLEAN_DATA($this->SeoName),
					"ShortContent"			=>	DB::SQL_INJECTION($this->ShortContent),
					"Content"				=>	DB::SQL_INJECTION($this->Content),
					"Images"				=>	$ImagesName.".".$ImagesExt,
					"Description"			=>	DB::CLEAN_DATA($this->Description),
					"Keywords"				=>	DB::CLEAN_DATA($this->Keywords),
					"Time"					=>	time(),
					"ISDELETED"				=>	"0"
				);
				$result = DB::insert("Activity", $data);
				if($result > 0)
				{
					$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
				}
				else
				{
					$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
				}
			
		}
		public function ActivityEdit($ID)
		{
			$this->ID = $ID;
			
			
			if($_FILES['Images']['name'] != '')
				{
					
					if($_FILES['Images'])
					{
						$images = $_FILES['Images'];
						$image = new Upload($images, 'tr_TR');
						
						$resultResolution = $this->connect->query("SELECT * FROM Resolution WHERE TableID = '3'");
						$lineResolution = $resultResolution->fetch(PDO::FETCH_OBJ);
						
						$resultImages = $this->connect->prepare("SELECT Images FROM Activity WHERE ID = ?");
						$resultImages->execute(array($this->ID));
						$lineImages = $resultImages->fetch(PDO::FETCH_OBJ);
						unlink("../Uploads/Activity/Big/".$lineImages->Images);

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
						$image->Process('../Uploads/Activity/Big');
						
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
					"ActivityCategoriesID"	=>	DB::CLEAN_DATA($this->ActivityCategoriesID),
					"Header"				=>	DB::CLEAN_DATA($this->Header),
					"SeoName"				=>	DB::CLEAN_DATA($this->SeoName),
					"ShortContent"			=>	DB::CLEAN_DATA($this->ShortContent),
					"Content"				=>	DB::SQL_INJECTION($this->Content),
					"Images"				=>	$ImagesName.".".$ImagesExt,
					"Description"			=>	DB::CLEAN_DATA($this->Description),
					"Keywords"				=>	DB::CLEAN_DATA($this->Keywords),
					"Time"					=>	time(),
				);
			}
			else
			{
				$data = array(
					"ActivityCategoriesID"	=>	DB::CLEAN_DATA($this->ActivityCategoriesID),
					"Header"				=>	DB::CLEAN_DATA($this->Header),
					"SeoName"				=>	DB::CLEAN_DATA($this->SeoName),
					"ShortContent"			=>	DB::CLEAN_DATA($this->ShortContent),
					"Content"				=>	DB::SQL_INJECTION($this->Content),
					"Images"				=>	$ImagesName.".".$ImagesExt,
					"Description"			=>	DB::CLEAN_DATA($this->Description),
					"Keywords"				=>	DB::CLEAN_DATA($this->Keywords),
					"Time"					=>	time(),
				);
			}
			$result = DB::update("Activity", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function ActivityDelete($ID)
		{			
			$this->ID = intval($ID);
			
			$resultImages = $this->connect->prepare("SELECT Images FROM Activity WHERE ID = ?");
			$resultImages->execute(array($this->ID));
			$lineImages = $resultImages->fetch(PDO::FETCH_OBJ);
			
			/* $result = $this->connect->prepare("DELETE FROM Activity WHERE ID = ?"); */
			$result = $this->connect->prepare("UPDATE Activity SET ISDELETED = '1' WHERE ID = ?");
			$result = $result->execute(array($ID));
			
			if($result)
			{
				unlink("../Uploads/Activity/Big/".$lineImages->Images);
				$this->OutPutMessage =  ViewReports::Success("Başarıyla Silindi");
			}
			else
			{
				$this->OutPutMessage =  ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		
	}
	
?>