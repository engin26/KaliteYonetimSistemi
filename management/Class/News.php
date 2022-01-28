<?php
	class News extends DB{
		public $ID;
		public $NewsCategoriesID;
		public $Header;
		public $SeoName;
		public $ShortContent;
		public $Content;
		public $Images;
		public $Cuff;
		public $Link;
		public $Click;
		public $Time;
		
		public $OutPutMessage;
		public $OutPutMessageImages;
		
		public function NewsList()
		{
			
			$result = $this->connect->query("SELECT newscategories.ID AS CatID, newscategories.Name, news.ID, news.newscategoriesID, news.Header, news.SeoName, news.ShortContent, news.Link, news.Content, news.Images,  news.Click, news.TimeSort FROM newscategories INNER JOIN news ON newscategories.ID = news.NewsCategoriesID WHERE news.ISDELETED = '0'");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function NewsFindID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT newscategories.ID AS CatID, newscategories.Name, news.ID, news.newscategoriesID, news.Header, news.SeoName, news.ShortContent, news.Link, news.Content, news.Cuff, news.Images, news.Click, news.TimeSort FROM newscategories INNER JOIN news ON newscategories.ID = news.NewsCategoriesID WHERE news.ISDELETED = '0' AND news.ID = ?");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		public function NewsAdd()
		{
				$Images = '';
				
				if($_FILES['Images']['name'] != '')
				{
					if($_FILES['Images'])
					{
						$images = $_FILES['Images'];
						$image = new Upload($images, 'tr_TR');
						
						$resultResolution = $this->connect->query("SELECT * FROM resolution WHERE TableID = '5'");
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
						$image->Process('../Uploads/News/Big');
						
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
					"NewsCategoriesID"		=>	"1",
					"Header"				=>	DB::CLEAN_DATA($this->Header),
					"SeoName"				=>	Library::Seo($this->Header),
					"ShortContent"			=>	DB::CLEAN_DATA($this->ShortContent),
					"Link"					=>	DB::CLEAN_DATA($this->Link),
					"Content"				=>	DB::SQL_INJECTION($this->Content),
					"Images"				=>	$Images,
					"Cuff"					=>	intval($this->Cuff),
					"Click"					=>	"0",
					"TimeSort"				=>	strtotime($this->TimeSort),
					"Time"					=>	time(),
					"ISDELETED"				=>	"0"
				);
			
				$result = DB::insert("news", $data);
				if($result > 0)
				{
					$this->OutPutMessage = ViewReports::Success("Başarıyla Eklendi");
				}
				else
				{
					$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
				}
			
		}
		public function NewsEdit($ID)
		{
			$this->ID = $ID;
			
			$Images = '';
			if($_FILES['Images']['name'] != '')
				{
					
					if($_FILES['Images'])
					{
						$images = $_FILES['Images'];
						$image = new Upload($images, 'tr_TR');
						
						$resultResolution = $this->connect->query("SELECT * FROM resolution WHERE TableID = '5'");
						$lineResolution = $resultResolution->fetch(PDO::FETCH_OBJ);
						
						$resultImages = $this->connect->prepare("SELECT Images FROM news WHERE ID = ?");
						$resultImages->execute(array($this->ID));
						$lineImages = $resultImages->fetch(PDO::FETCH_OBJ);
						
						unlink("../Uploads/News/Big/".$lineImages->Images);

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
						$image->Process('../Uploads/News/Big');
						
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
					"NewsCategoriesID"		=>	"1",
					"Header"				=>	DB::CLEAN_DATA($this->Header),
					"SeoName"				=>	Library::Seo($this->Header),
					"ShortContent"			=>	DB::CLEAN_DATA($this->ShortContent),
					"Link"					=>	DB::CLEAN_DATA($this->Link),
					"Content"				=>	DB::SQL_INJECTION($this->Content),
					"Cuff"					=>	DB::SQL_INJECTION($this->Cuff),
					"TimeSort"				=>	strtotime($this->TimeSort),
					"Time"					=>	time()
				);
				
				if($Images != '')
				{
					$data['Images'] = $Images;
				}
			
			$result = DB::update("news", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function NewsDelete($ID)
		{			
			$this->ID = intval($ID);
			
			/*$resultImages = $this->connect->prepare("SELECT Images FROM News WHERE ID = ?");
			$resultImages->execute(array($this->ID));
			$lineImages = $resultImages->fetch(PDO::FETCH_OBJ);
			
			$result = $this->connect->prepare("DELETE FROM News WHERE ID = ?");
			$result = $result->execute(array($ID));*/

			$result = $this->connect->prepare("UPDATE news SET ISDELETED = '1' WHERE ID = ?");
			$result = $result->execute(array($ID));

			if($result)
			{
				//unlink("../Uploads/News/Big/".$lineImages->Images);
				$this->OutPutMessage =  ViewReports::Success("Başarıyla Silindi");
			}
			else
			{
				$this->OutPutMessage =  ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		
	}
	
?>