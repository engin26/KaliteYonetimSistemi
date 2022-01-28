<?php
	class Media extends MediaCategories{
		public $ID;
		public $MediaCategoriesID;
		public $Type;
		public $Header;
		public $SeoName;
		public $ShortContent;
		public $Content;
		public $Images;
		public $VideoURL;
		public $VideoRouterURL;
		public $Cuff;
		public $Link;
		public $Click;
		public $Time;
		
		public $OutPutCategoriesPath;
		public $OutPutMessage;
		public $OutPutMessageImages;
		
		public function MediaList()
		{
			
			$result = $this->connect->query("SELECT MediaCategories.ID AS CatID, MediaCategories.Name, Media.ID, Media.MediaCategoriesID, Media.Header, Media.SeoName, Media.ShortContent, Media.Content, Media.Images,  Media.Click, Media.TimeSort FROM MediaCategories INNER JOIN Media ON MediaCategories.ID = Media.MediaCategoriesID WHERE Media.ISDELETED = '0'");
			
			$line = $result->fetchAll(PDO::FETCH_OBJ);
			
			//$this->OutPutCategoriesPath = $this->
			
			return $line;
		}
		public function MediaFindID($ID)
		{
			$this->ID = $ID;
			
			$result = $this->connect->prepare("SELECT MediaCategories.ID AS CatID, Media.Type AS Type, Media.VideoPage,  MediaCategories.Name, Media.ID, Media.MediaCategoriesID, Media.Header, Media.SeoName, Media.ShortContent, Media.VideoURL, Media.VideoRouterURL, Media.Content, Media.Cuff, Media.Images, Media.Click, Media.TimeSort FROM MediaCategories INNER JOIN Media ON MediaCategories.ID = Media.MediaCategoriesID WHERE Media.ISDELETED = '0' AND Media.ID = ?");
			$result->execute(array($this->ID));
			
			$line = $result->fetch(PDO::FETCH_OBJ);
			
			return $line;
		}
		
		public function MediaAdd()
		{
				$Images = '';

				foreach ($_FILES['Images'] as $k => $l) {
				  foreach ($l as $i => $v) {
				   if (!array_key_exists($i, $resimler))
					 $resimler[$i] = array();
				   $resimler[$i][$k] = $v;
				  }
				}
			foreach ($resimler as $resim)
			{
				
					if($_FILES['Images'])
					{
						$image = new Upload($resim, 'tr_TR');
						
						$resultResolution = $this->connect->query("SELECT * FROM Resolution WHERE TableID = '12'");
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
						$image->Process('../Uploads/Media/Big');
						
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

				$data = array(
					"MediaCategoriesID"		=>	intval($this->MediaCategoriesID),
					"Type"					=>	intval($this->Type),
					"VideoPage"				=>	intval($this->VideoPage),
					"Header"				=>	DB::CLEAN_DATA($this->Header),
					"SeoName"				=>	Library::Seo($this->Header),
					"ShortContent"			=>	DB::CLEAN_DATA($this->ShortContent),
					"Content"				=>	DB::SQL_INJECTION($this->Content),
					"Images"				=>	$Images,
					"VideoURL"				=>	DB::CLEAN_DATA($this->VideoURL),
					"VideoRouterURL"		=>	DB::CLEAN_DATA($this->VideoRouterURL),
					"Cuff"					=>	intval($this->Cuff),
					"Click"					=>	"0",
					"TimeSort"				=>	strtotime($this->TimeSort),
					"Time"					=>	time(),
					"ISDELETED"				=>	"0"
				);
			
				$result = DB::insert("Media", $data);
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
		public function MediaEdit($ID)
		{
			$this->ID = $ID;
			
			$Images = '';
				if($_FILES['Images']['name'] != '')
				{
					
					if($_FILES['Images'])
					{
						$images = $_FILES['Images'];
						$image = new Upload($images, 'tr_TR');
						
						$resultResolution = $this->connect->query("SELECT * FROM Resolution WHERE TableID = '12'");
						$lineResolution = $resultResolution->fetch(PDO::FETCH_OBJ);
						
						$resultImages = $this->connect->prepare("SELECT Images FROM Media WHERE ID = ?");
						$resultImages->execute(array($this->ID));
						$lineImages = $resultImages->fetch(PDO::FETCH_OBJ);
						
						unlink("../Uploads/Media/Big/".$lineImages->Images);

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
						$image->Process('../Uploads/Media/Big');
						
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
					//"MediaCategoriesID"	=>	intval($this->MediaCategoriesID),
					"VideoPage"				=>	intval($this->VideoPage),
					"Header"				=>	DB::CLEAN_DATA($this->Header),
					"Type"					=>	DB::CLEAN_DATA($this->Type),
					"SeoName"				=>	Library::Seo($this->Header),
					"ShortContent"			=>	DB::CLEAN_DATA($this->ShortContent),
					"Content"				=>	DB::SQL_INJECTION($this->Content),
					"VideoURL"				=>	DB::CLEAN_DATA($this->VideoURL),
					"VideoRouterURL"		=>	DB::CLEAN_DATA($this->VideoRouterURL),
					"Cuff"					=>	DB::SQL_INJECTION($this->Cuff),
					"TimeSort"				=>	strtotime($this->TimeSort),
					"Time"					=>	time()
				);
				
				if($Images != '')
				{
					$data['Images'] = $Images;
				}
				
			$result = DB::update("Media", $data, "ID = ".$this->ID);
			if($result > 0)
			{
				$this->OutPutMessage = ViewReports::Success("Başarıyla Düzenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Oluştu.!!!");
			}
		}
		public function MediaDelete($ID)
		{			
			$this->ID = intval($ID);
			
			/*$resultImages = $this->connect->prepare("SELECT Images FROM Media WHERE ID = ?");
			$resultImages->execute(array($this->ID));
			$lineImages = $resultImages->fetch(PDO::FETCH_OBJ);
			
			$result = $this->connect->prepare("DELETE FROM Media WHERE ID = ?");
			$result = $result->execute(array($ID));*/

			$result = $this->connect->prepare("UPDATE Media SET ISDELETED = '1' WHERE ID = ?");
			$result = $result->execute(array($ID));

			if($result)
			{
				//unlink("../Uploads/Media/Big/".$lineImages->Images);
				$this->OutPutMessage =  ViewReports::Success("Başarıyla Silindi");
			}
			else
			{
				$this->OutPutMessage =  ViewReports::Error("Hata Oluştu.!!!");
			}
		}







		public function Kategori_List($Kategori_Id=0)
	{
	    /*
	     *  Kategori Listesini Array olarak döndürür.
	     *  
	     *  Eğer $Kategori_Id SET edilmiş ise sadece o kategorinin alt kategorilerinin döndürür.
	     * 
	     */
	 
	    // Kategorilerin bulunduğu tablomuzdan tüm kayıtları alıyoruz.
	    $request=$this->connect->query('SELECT ID, Name, SupID FROM MediaCategories ORDER BY Name ASC');
	    // $list değişkeninde sırayla tümkategoriler bulunuyor.
	    $list=array();
	    while($row=$request->fetchAll(PDO::FETCH_ASSOC)){
	        $list[$row['ID']]=$row;
	    }
	    //mysql_free_result($request);
	 
	    // Şimdi sırayla eklenmişleri hiyerarşilenmiş bir biçimde $tree değişkenine vereceğiz.
	    $tree = array();
	 
	    // Her bir kategoriyi tek tek döndür...
	    foreach ($list as $id => $item)
	    {
	 	
	        if ($Kategori_Id > 0){
	            // Eğer kategori id set edilmiş ise birincil düzey yap...
	            $kontrol=$Kategori_Id;
	        }else{
	            // Eğer kategori birincil düzey ise... (yani alt kategorileri almıyoruz!)
	            $kontrol=0;
	        }
	 
	        if ($item['SupID'] == $kontrol)
	        {
	            // $tree değişekeninde birincil düzey olarak ekledik.
	            $tree[$item['ID']] = $item;
	 
	            // Bu kategoriyi kaydettiğimiz için de (yani işimiz bitti!) $list dizisinden kaldırıyoruz.
	            unset($list[$id]);
	 
	            // Ve şimdi can alıcı nokta! Bu ana kategorinin alt kategorisi var mı diye alt kategorilerine bakıyoruz...
	            $this->Kategori_Find_Sub_Cats($list, $tree[$item['ID']]);
	        }
	    }
	 
	    return $tree;
	}
	 
	public function Kategori_Find_Sub_Cats(&$list, &$selected)
	{
	    /*  Kategori_List() fonksiyonu ile beraber çalışır.
	     *  Alt kategorileri arayan yardımcı fonksiyonumuz.
	     *  &$list: Veritabanından çektiğimiz ham kategorileri içeriyor.
	     *  &$selected: Üzerinde işlem yapılacak (varsa alt kategorisi eklenecek) kategoriyi içeriyor.
	     */
	 
	    // Her bir kategoriyi tek tek döndür...
	    foreach ($list as $id => $item)
	    {
	        // Eğer babasının kimliğiyle kendi kimliği aynıysa... (yani alt kategori ise!)
	        if ($item['SupID'] == $selected['ID'])
	        {
	            // Seçimin "sub_cats"ına alt kategorisini ekle.
	            $selected['sub_cats'][$item['ID']] = $item;
	 
	            // Babasını bulduğuna göre artık $list'eden kaldırabiliriz.
	            unset($list[$id]);
	 
	            // Alt kategorinin de çocuğu olabilme ihtimali için aynı işlemleri ona da yapıyoruz...
	            $this->Kategori_Find_Sub_Cats($list, $selected['sub_cats'][$item['ID']]);
	        }
	    }
	}
		
}


	
?>