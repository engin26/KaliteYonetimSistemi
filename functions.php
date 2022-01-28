<?php
function filesCategoriesFind($ID)
{
	global $db;

	$result = $db->prepare("SELECT * FROM filesCategories WHERE ID = ?");
	$result->execute(array($ID));
	$line = $result->fetch(PDO::FETCH_OBJ);

	return $line;
}


	function SettingsList()
	{
		global $db;

		$result = $db->query("SELECT * FROM settings WHERE ID = 1");
		$line = $result->fetch(PDO::FETCH_OBJ);

		return $line;
	}
	function MainMenuList()
	{
		global $db;

		$result = $db->query("SELECT * FROM mainmenu WHERE SupID = 0 AND ISDELETED=0");
		$line = $result->fetchAll(PDO::FETCH_OBJ);

		return $line;
	}
	function NewsList($NewsCategoriesID)
	{
		global $db;
		$NewsCategoriesID = intval($NewsCategoriesID);

		$result = $db->prepare("SELECT * FROM news WHERE NewsCategoriesID = ? AND ISDELETED=0");
		$result->execute(array($NewsCategoriesID));
		$line = $result->fetchAll(PDO::FETCH_OBJ);

		return $line;
	}
	function ContentCategoriesList()
	{
		global $db;

		$result = $db->query("SELECT * FROM contentcategories WHERE ISDELETED=0");
		$line = $result->fetchAll(PDO::FETCH_OBJ);

		return $line;
	}
	function GalleryList($GalleryCategoriesID)
	{
		global $db;
		$GalleryCategoriesID = intval($GalleryCategoriesID);

		$result = $db->query("SELECT * FROM gallery WHERE GalleryCategoriesID = ".$GalleryCategoriesID." AND ISDELETED=0");
		$line = $result->fetchAll(PDO::FETCH_OBJ);

		return $line;
	}

	function strto($to, $str) {
	    if($to == 'lower') {
	        return mb_strtolower(str_replace(array('I','Ğ','Ü','Ş','İ','Ö','Ç'), array('ı','ğ','ü','ş','i','ö','ç'), $str), 'utf-8');
	    }
	    elseif($to == 'upper') {
	        return mb_strtoupper(str_replace(array('ı','ğ','ü','ş','i','ö','ç'), array('I','Ğ','Ü','Ş','İ','Ö','Ç'), $str), 'utf-8');
	    }
	    elseif($to == 'ucfirst') {
	        return ucfirst(str_replace(array('ı','ğ','ü','ş','i','ö','ç'), array('I','Ğ','Ü','Ş','İ','Ö','Ç'), $str), 'utf-8');
	    }
	    else { trigger_error('Lütfen geçerli bir strto() parametresi giriniz.', E_USER_ERROR); }
	}

	function ucwords_tr($gelen){

	  $sonuc='';
	  $kelimeler=explode(" ", $gelen);

	  foreach ($kelimeler as $kelime_duz){

	    $kelime_uzunluk=strlen($kelime_duz);
	    $ilk_karakter=mb_substr($kelime_duz,0,1,'UTF-8');

	    if($ilk_karakter=='Ç' or $ilk_karakter=='ç'){
	      $ilk_karakter='Ç';
	    }elseif ($ilk_karakter=='Ğ' or $ilk_karakter=='ğ') {
	      $ilk_karakter='Ğ';
	    }elseif($ilk_karakter=='I' or $ilk_karakter=='ı'){
	      $ilk_karakter='I';
	    }elseif ($ilk_karakter=='İ' or $ilk_karakter=='i'){
	      $ilk_karakter='İ';
	    }elseif ($ilk_karakter=='Ö' or $ilk_karakter=='ö'){
	      $ilk_karakter='Ö';
	    }elseif ($ilk_karakter=='Ş' or $ilk_karakter=='ş'){
	      $ilk_karakter='Ş';
	    }elseif ($ilk_karakter=='Ü' or $ilk_karakter=='ü'){
	      $ilk_karakter='Ü';
	    }else{
	      $ilk_karakter=strtoupper($ilk_karakter);
	    }

	    $digerleri=mb_substr($kelime_duz,1,$kelime_uzunluk,'UTF-8');
	    $sonuc.=$ilk_karakter.kucuk_yap($digerleri).' ';

	  }

	  $son=trim(str_replace('  ', ' ', $sonuc));
	  return $son;

	}

	function kucuk_yap($gelen){

	  $gelen=str_replace('Ç', 'ç', $gelen);
	  $gelen=str_replace('Ğ', 'ğ', $gelen);
	  $gelen=str_replace('I', 'ı', $gelen);
	  $gelen=str_replace('İ', 'i', $gelen);
	  $gelen=str_replace('Ö', 'ö', $gelen);
	  $gelen=str_replace('Ş', 'ş', $gelen);
	  $gelen=str_replace('Ü', 'ü', $gelen);
	  $gelen=strtolower($gelen);

	  return $gelen;
	}

	function trDate($str){
		return date("d.m.Y", strtotime($str));
	}
	function RevNoAdd($revNo){
		if ($revNo<10) {
			$revNo='0'.$revNo ;
		}

		return $revNo;
	}

?>
