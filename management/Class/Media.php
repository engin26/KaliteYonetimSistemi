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
						/* Y??klenen Resim Boyutlar?? */
						$Width = $image->image_src_x;
						$Height = $image->image_src_y;
						
						$ImagesExt = $image->file_src_name_ext;
						/* B??y??k Resim Ayarlar?? */
						if($lineResolution->BigWidth == 'auto') $DefaultBigWidth = $Width; else $DefaultBigWidth = $lineResolution->BigWidth;
									
						$DefaultBigHeight = ceil(($Height * $DefaultBigWidth) / $Width);
								
						if($lineResolution->BigHeight != 'auto') $DefaultBigHeight = $lineResolution->BigHeight;
						

						$Time = time();
						// B??y??k Resim ????in
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
							$this->OutPutMessageImages = "Resim Ba??ar??yla Eklendi, L??tfen Bekleyiniz";
							$Upload = 1;
							$Images = $ImagesName.".".$ImagesExt;
						}
						else{
							$this->OutPutMessageImages = "Resim Eklemede Hata Olu??tu, L??tfen Bekleyiniz";
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
					$this->OutPutMessage = ViewReports::Success("Ba??ar??yla Eklendi");
				}
				else
				{
					$this->OutPutMessage = ViewReports::Error("Hata Olu??tu.!!!");
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
						/* Y??klenen Resim Boyutlar?? */
						$Width = $image->image_src_x;
						$Height = $image->image_src_y;
						
						$ImagesExt = $image->file_src_name_ext;
						/* B??y??k Resim Ayarlar?? */
						if($lineResolution->BigWidth == 'auto') $DefaultBigWidth = $Width; else $DefaultBigWidth = $lineResolution->BigWidth;
									
						$DefaultBigHeight = ceil(($Height * $DefaultBigWidth) / $Width);
								
						if($lineResolution->BigHeight != 'auto') $DefaultBigHeight = $lineResolution->BigHeight;
						
						$Time = time();
						// B??y??k Resim ????in
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
							$this->OutPutMessageImages = "Resim Ba??ar??yla Eklendi, L??tfen Bekleyiniz";
							$Upload = 1;
							$Images = $ImagesName.".".$ImagesExt;
						}
						else{
							$this->OutPutMessageImages = "Resim Eklemede Hata Olu??tu, L??tfen Bekleyiniz";
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
				$this->OutPutMessage = ViewReports::Success("Ba??ar??yla D??zenlendi");
			}
			else
			{
				$this->OutPutMessage = ViewReports::Error("Hata Olu??tu.!!!");
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
				$this->OutPutMessage =  ViewReports::Success("Ba??ar??yla Silindi");
			}
			else
			{
				$this->OutPutMessage =  ViewReports::Error("Hata Olu??tu.!!!");
			}
		}







		public function Kategori_List($Kategori_Id=0)
	{
	    /*
	     *  Kategori Listesini Array olarak d??nd??r??r.
	     *  
	     *  E??er $Kategori_Id SET edilmi?? ise sadece o kategorinin alt kategorilerinin d??nd??r??r.
	     * 
	     */
	 
	    // Kategorilerin bulundu??u tablomuzdan t??m kay??tlar?? al??yoruz.
	    $request=$this->connect->query('SELECT ID, Name, SupID FROM MediaCategories ORDER BY Name ASC');
	    // $list de??i??keninde s??rayla t??mkategoriler bulunuyor.
	    $list=array();
	    while($row=$request->fetchAll(PDO::FETCH_ASSOC)){
	        $list[$row['ID']]=$row;
	    }
	    //mysql_free_result($request);
	 
	    // ??imdi s??rayla eklenmi??leri hiyerar??ilenmi?? bir bi??imde $tree de??i??kenine verece??iz.
	    $tree = array();
	 
	    // Her bir kategoriyi tek tek d??nd??r...
	    foreach ($list as $id => $item)
	    {
	 	
	        if ($Kategori_Id > 0){
	            // E??er kategori id set edilmi?? ise birincil d??zey yap...
	            $kontrol=$Kategori_Id;
	        }else{
	            // E??er kategori birincil d??zey ise... (yani alt kategorileri alm??yoruz!)
	            $kontrol=0;
	        }
	 
	        if ($item['SupID'] == $kontrol)
	        {
	            // $tree de??i??ekeninde birincil d??zey olarak ekledik.
	            $tree[$item['ID']] = $item;
	 
	            // Bu kategoriyi kaydetti??imiz i??in de (yani i??imiz bitti!) $list dizisinden kald??r??yoruz.
	            unset($list[$id]);
	 
	            // Ve ??imdi can al??c?? nokta! Bu ana kategorinin alt kategorisi var m?? diye alt kategorilerine bak??yoruz...
	            $this->Kategori_Find_Sub_Cats($list, $tree[$item['ID']]);
	        }
	    }
	 
	    return $tree;
	}
	 
	public function Kategori_Find_Sub_Cats(&$list, &$selected)
	{
	    /*  Kategori_List() fonksiyonu ile beraber ??al??????r.
	     *  Alt kategorileri arayan yard??mc?? fonksiyonumuz.
	     *  &$list: Veritaban??ndan ??ekti??imiz ham kategorileri i??eriyor.
	     *  &$selected: ??zerinde i??lem yap??lacak (varsa alt kategorisi eklenecek) kategoriyi i??eriyor.
	     */
	 
	    // Her bir kategoriyi tek tek d??nd??r...
	    foreach ($list as $id => $item)
	    {
	        // E??er babas??n??n kimli??iyle kendi kimli??i ayn??ysa... (yani alt kategori ise!)
	        if ($item['SupID'] == $selected['ID'])
	        {
	            // Se??imin "sub_cats"??na alt kategorisini ekle.
	            $selected['sub_cats'][$item['ID']] = $item;
	 
	            // Babas??n?? buldu??una g??re art??k $list'eden kald??rabiliriz.
	            unset($list[$id]);
	 
	            // Alt kategorinin de ??ocu??u olabilme ihtimali i??in ayn?? i??lemleri ona da yap??yoruz...
	            $this->Kategori_Find_Sub_Cats($list, $selected['sub_cats'][$item['ID']]);
	        }
	    }
	}
		
}


	
?>