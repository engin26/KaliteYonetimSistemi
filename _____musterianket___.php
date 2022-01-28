<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Ücretli İşler</title>
	
	<!--Responsiveness-->
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link rel="stylesheet" href="css/design.css" type="text/css" media="screen, projection" />
	<link rel="stylesheet" href="css/menu2.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="css/table.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" href="css/font.css" type="text/css" media="screen, projection" />
  	<link rel="stylesheet" href="sss/sss.css" type="text/css" media="all">   
	
	<link rel="stylesheet" href="css/sagmenu.css">

	
	
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="sss/sss.min.js"></script> 
        <script>    
            jQuery(function($) {
                $('.slider').sss();
            });
			
        </script>
	<!--FontAwesome-->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!--[if IE 7]>
    <link rel="stylesheet" href="font-awesome/css/font-awesome-ie7.min.css">
    <![endif]-->
	
	<!--CSS Style-->
    <link href="css/demo.css" rel="stylesheet" type="text/css" />
    <link href="css/ace-responsive-menu.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="wrapper">
    <!-- Ace Responsive Menu -->
    <nav>
	
        <div id="header"><img src="images/banner.png" style="width:96%; height:auto; "></div>
		<style>
		#search-box { position: relative; width: 300px; margin: 0; }
		#search-form { height: 40px; border: 1px solid #999; -webkit-border-radius: 5px; -moz-border-radius: 5px; border-radius: 5px;background-color: #fff; overflow: hidden; }
		#search-text { font-size: 14px; color: white; border-width: 0; background: transparent; }
		#search-box input[type="text"] { width: 90%; padding: 11px 0 12px 1em; color: #333; outline: none; }
		#search-button { position: absolute; top: 0; right: 0; height: 42px; width: 80px; font-size: 14px; 
		color: #173db9; text-align: center; line-height: 42px; border-width: 0; background-color: #4d90fe; -webkit-border-radius: 0px 5px 5px 0px;
		-moz-border-radius: 0px 5px 5px 0px; border-radius: 0px 5px 5px 0px; cursor: pointer; } 
		

		
		img {width: 200px; height: 100px;border-radius: 10px;border-color: #82a2bb;border-style: ridge;border-width: 5px; cellpadding: 10px; margin-left:20px;background-color: #263d50;
			color: #263d50;	font-weight: bold;	padding: 2px;	-moz-border-radius: 0px;	-webkit-border-radius: 0px;
			}
			

		
		
		</style> 
		<div id='search-box'> <form action='/search' id='search-form' method='get' target='_top'> <input id='search-text' name='q' placeholder='Arama Yapma...' type='text'/> <button id='search-button' type='submit'><span>Arama</span></button> </form> </div> 
		 
		
        <div class="menu-toggle">
		
            <h3>Menu</h3>
            <button type="button" id="menu-btn">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Responsive Menu Structure-->
        <!--Note: declare the Menu style in the data-menu-style="horizontal" (options: horizontal, vertical, accordion) -->
        <ul id="respMenu" class="ace-responsive-menu" data-menu-style="accordion">
            <li><a href="index.html"><i class="fa fa-home" aria-hidden="true"></i><span class="title">Ana Sayfa</span></a></li>
			
			           
            
			<li><a href="javascript:;"><i class="fa fa-cubes" aria-hidden="true"></i><span class="title">Numune Hazırlama</span></a>
            <ul>
                    <li><a href="Sayfalar/1NumuneHazırlama/numunehazirlama.html">Numune Hazırlama</a></li>	
			</ul>
			<li><a href="javascript:;"><i class="fa fa-flask" aria-hidden="true"></i><span class="title">Analitik Kimya</span></a>
				<ul>
                    <li><a href="Sayfalar/2Analitik/sunumune.html">Su Analizleri (Numune Kabul Şartları)</a></li>
                    <li><a href="Sayfalar/2Analitik/su.html">Su Analizleri</a></li>
                    <li><a href="Sayfalar/2Analitik/endustriyelhammadde.html">Endüstriyel Hammadde ve Cevher Analizleri-Klasik (Yaş) Yöntemler</a></li>
                    <li><a href="Sayfalar/2Analitik/komurkulu.html">Kömür Külü ve Çimento Analizleri-Klasik (Yaş) Yöntemler</a></li>
					<li><a href="Sayfalar/2Analitik/blisterbakir.html">Bilister Bakır Analizleri</a></li>
					<li><a href="Sayfalar/2Analitik/metalcelik.html">Metal-Çelik ve Alaşımlarında C (Karbon) ve S (Kükürt) Analizleri</a></li>					
                </ul>
						 
			<li><a href="javascript:;"><i class="fa fa-line-chart" aria-hidden="true"></i><span class="title">Jeokimya</span></a>
                <ul>
                    <li><a href="Sayfalar/3Jeokimya/jeokimyasal.html">Jeokimyasal Analizler</a></li>
                    <li><a href="Sayfalar/3Jeokimya/kiymetlimetal.html">Kıymetli Metal (Soymetal) Analizleri</a></li>
                    <li><a href="Sayfalar/3Jeokimya/metalcelik.html">Metal-Çelik ve Alaşım Analizleri</a></li>
                    <li><a href="Sayfalar/3Jeokimya/xrf.html">XRF Analizleri</a></li>
                    <li><a href="Sayfalar/3Jeokimya/icpoes.html">ICP-OES ile Kantitatif Eser Element Analizleri</a></li>
					<li><a href="Sayfalar/3Jeokimya/icpms.html">ICP-MS ile Kantitatif Eser Element Analizleri</a></li>
					<li><a href="Sayfalar/3Jeokimya/tamteknoloji.html">Tam Teknoljik Çalışmalara Yönelik Eser Element Analizleri</a></li>					
                </ul>				
				
			<li><a href="javascript:;"><i class="fa fa-free-code-camp" aria-hidden="true"></i><span class="title">Kömür Analizleri</span></a>
                <ul>
                    <li><a href="Sayfalar/4Kömür/komur.html">Kömür Analizleri</a></li>
                    <li><a href="Sayfalar/4Kömür/komurfiziksel.html">Kömürde Fiziksel Analizler</a></li>
                </ul>
				
			<li><a href="javascript:;"><i class="fa fa-diamond" aria-hidden="true"></i><span class="title">Mineroloji ve Petrografi Araştırmaları</span></a>
				<ul>
                    <li><a href="Sayfalar/5Minpet/minpet.html">Minerolojik-Petrografik Analizler</a></li>
                    <li><a href="Sayfalar/5Minpet/organikpet.html">Organik (Kömür) Petrografisi Analizleri</a></li>
                    <li><a href="Sayfalar/5Minpet/sıvıkapanim.html">Sıvı Kapanım Analizleri</a></li>
                    <li><a href="Sayfalar/5Minpet/xrd.html">X-Işınımı Kırınımı (XRD) Analizleri</a></li>
                    <li><a href="Sayfalar/5Minpet/bobrekvemesane.html">Böbrek ve Mesane Taşı Analizleri</a></li>
                    <li><a href="Sayfalar/5Minpet/sem.html">Taramalı Elektron Mikroskobu (SEM) Analizleri</a></li>
                    <li><a href="Sayfalar/5Minpet/mla.html">Mineral Serbestleşme(MLA)Analizleri </a></li>
                    <li><a href="Sayfalar/5Minpet/fıtır.html">Fourier Dönüşümlü Kızıl Ötesi (FT-IR) Spektrometresi Analizleri</a></li>
                    <li><a href="Sayfalar/5Minpet/tamteknoloji.html">Tam Teknolojik Çalışmalara Yönelik Minerolojik-Petrografik Analizler</a></li>
                    <li><a href="Sayfalar/5Minpet/yurtdışı.html">Yurt Dışına Gönderilecek Olan Örneklere Uygulanan Analizler</a></li>
                </ul>
                
			<li><a href="javascript:;"><i class="fa fa-compass" aria-hidden="true"></i><span class="title">Endüstriyel Hammaddeler ve Seramik Malzemeleri Araştırmaları</span></a>
             	<ul>
                    <li><a href="Sayfalar/6Seramik/refrakter.html">Seramik,Refrakter ve Toz Metalurjisi Teknolojik Testleri</a></li>
                    <li><a href="Sayfalar/6Seramik/fizikselgenel.html">Fiziksel Genel Testler</a></li>
                    <li><a href="Sayfalar/6Seramik/tuglakiremit.html">Tuğla-Kiremit Hammaddesi Teknolojik Testleri</a></li>
                    <li><a href="Sayfalar/6Seramik/seramikhammadde.html">Seramik Hammaddesi Teknoljik Testleri</a></li>
                    <li><a href="Sayfalar/6Seramik/bentonit.html">Bentonit Hammadesi Teknolojik Testleri</a></li>
                    <li><a href="Sayfalar/6Seramik/dokumkumu.html">Döküm Kumu Teknolojik Testleri</a></li>
                    <li><a href="Sayfalar/6Seramik/barit.html">Barit Teknolojik Testleri</a></li>
                    <li><a href="Sayfalar/6Seramik/agrega.html">Agrega Teknolojik Testleri</a></li>
                    <li><a href="Sayfalar/6Seramik/kiractasi.html">Kireç Taşı Hammaddesi Teknolojik Testleri</a></li>
                    <li><a href="Sayfalar/6Seramik/tras.html">Traş Hammaddesi Teknolojik Testleri</a></li>
                    <li><a href="Sayfalar/6Seramik/killerdegenlesme.html">Killerde Genleşme Oranı Testleri</a></li>
                    <li><a href="Sayfalar/6Seramik/kuvarsit.html">Kuvarsit Teknolojik Testleri</a></li>
                    <li><a href="Sayfalar/6Seramik/sepiyolit.html">Sepiyolit Hammaddesi Teknolojik Testleri</a></li>
                    <li><a href="Sayfalar/6Seramik/zeolit.html">Zeolit Hammadesi Teknolojik Testleri</a></li>
                    <li><a href="Sayfalar/6Seramik/dogaltas.html">Doğal Taş Teknolojik Testleri</a></li>
                    <li><a href="Sayfalar/6Seramik/diger.html">Diğer Teknolojik Testler</a></li>
                </ul>
			 
			<li><a href="javascript:;"><i class="fa fa-industry" aria-hidden="true"></i><span class="title">Cevher Zenginleştirme ve Metalurji</span></a>
                <ul>
                    <li><a href="Sayfalar/7Cevher/kirmaogutme.html">Cevher Zenginleştirme (Kırma-Öğütme-Eleme)</a></li>
                    <li><a href="Sayfalar/7Cevher/cevherzengn.html">Cevher Zenginleştirme Teknolojik Testleri</a></li>
                    <li><a href="Sayfalar/7Cevher/pirometalurjik.html">Pirometalurjik İşlemler</a></li>
                    <li><a href="Sayfalar/7Cevher/metalografik.html">Metalografik İşlemler</a></li>
                    <li><a href="Sayfalar/7Cevher/hidrometalurjik.html">Hidrometalurjik İşlemler</a></li>
                    <li><a href="Sayfalar/7Cevher/diger.html">Diğer Metalürjik İşlemler</a></li>
                </ul>
				
		    <li><a href="javascript:;"><i class="fa fa-balance-scale" aria-hidden="true"></i><span class="title">Kalibrasyon İşlemleri</span></a>
                
						 <ul><li><a href="Sayfalar/8Kalibrasyon/agirlik.html">Ağırlık Kalibrasyon İşlemleri</a></li></ul>
						 <ul><li><a href="Sayfalar/8Kalibrasyon/sicaklik.html">Sıcaklık Kalibrasyon İşlemleri</a></li></ul>
						 <ul><li><a href="Sayfalar/8Kalibrasyon/hacim.html">Hacim Kalibrasyon İşlemleri</a></li></ul>
						 <ul><li><a href="Sayfalar/8Kalibrasyon/boyut.html">Boyut Kalibrasyon İşlemleri</a></li></ul>
				               
                        
			</li>
			<li>
                <a href="javascript:;"><i class="fa fa-university" aria-hidden="true"></i><span class="title">Diğer Hizmetler</span></a>
               
                <ul>
                    <li><a href="Sayfalar/9Arge/arge.html">Araştırma-Geliştirme (AR_GE)</a>
                        <a href="Sayfalar/10Danışmanlık/danismanlik.html">Danışmanlık</a>
                        <a href="Sayfalar/11Eğitim/egitim.html">Eğitim</a>
					</li>                   
                </ul>    				
            </li>
            
        </ul>


      
		
    </nav>    <!-- End of Responsive Menu -->
	
<div id='cssmenu'>

<ul>
	<li><a href="#"><i class="fa fa-safari" aria-hidden="true" style="color:#FF5737;"></i><span class="title" style="margin-left:10px";>Analiz/Test ve Kalibrasyon Hizmetleri</span></a></li>
	<li><a href="basvurusartlari.html"><i class="fa fa-edit" aria-hidden="true" style="color:#FF5737; margin-left:15px;"></i><span class="title" style="margin-left:10px";>Başvuru Şartları</span></a></li>
	<li><a href="numunekabulsartlari.html"><i class="fa fa-check-square-o" aria-hidden="true" style="color:#FF5737;margin-left:15px;"></i><span class="title" style="margin-left:10px";>Numune Kabul Şartları</span></a></li>
	<li><a href="hizmetsuresi.html"><i class="fa fa-hourglass-half" aria-hidden="true" style="color:#FF5737;margin-left:15px;"></i><span class="title" style="margin-left:10px";>Hizmet Süresi</span></a></li>
	<li><a href="hizmetbedeli.html"><i class="fa fa-try" aria-hidden="true" style="color:#FF5737;margin-left:15px;"></i><span class="title" style="margin-left:13px";>Hizmet Bedeli</span></a></li>
	<li><a href="hizmetbedelininodenmesi.html"><i class="fa fa-credit-card" aria-hidden="true" style="color:#FF5737;margin-left:15px;"></i><span class="title" style="margin-left:8px";>Hizmet Bedelinin Ödenmesi</span></a></li>
	<li><a href="numunesaklamasartlari.html"><i class="fa fa-archive" aria-hidden="true" style="color:#FF5737;margin-left:15px;"></i><span class="title" style="margin-left:10px";>Numune Saklama Şartları</span></a></li>
	<li><a href="kisaltmalarvekodlamalar.html"><i class="fa fa-file-code-o" aria-hidden="true" style="color:#FF5737;margin-left:15px;"></i><span class="title" style="margin-left:10px";>Kısaltmalar ve Kodlamalar</span></a></li><br></br>
	
 
  
   
</ul>
<ul>
<li><a href="kaliteyonetim.html"><i class="fa fa-eye" aria-hidden="true" style="color:#FF5737;"></i><span class="title" style="margin-left:10px";>Kalite Yönetim Sistemi ve Laboratuvar Akreditasyonu</span></a></li>
<li><a href="Kalite Politikası.pdf" target="_blank"><i class="fa fa-pinterest-p" aria-hidden="true" style="color:#FF5737;margin-left:0px;"></i><span class="title" style="margin-left:14px";>Kalite Politikası</span></a></li>
	<li><a href="Akreditasyonsertifikası.pdf" target="_blank"><i class="fa fa-certificate" aria-hidden="true" style="color:#FF5737;margin-left:0px;"></i><span class="title" style="margin-left:14px";>Akreditasyon Sertifikaları</span></a></li><br></br>
	<li><img src="images/akreditasyonsertifikası.jpg"></i><span class="title" style="margin-left:10px";>türkak resim</span></a></li>
</ul>

</div><br></br>

<div style="margin-left:350px;margin-right:300px;" >
<?
include('../../../v3.0/data/kepce.php');
kepce_veri();
session_start();
session_register("adsoyad");
session_register("adres");
session_register("telefon");
session_register("gorus");
session_register("eposta");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?

function kol($kontes) {
if(ereg("['|$~*<>?]", $kontes))
return FALSE;
	else 
return TRUE;
}

function hata($yazi){ 
global  $hatasayac,$hatalar; 
if($yazi<>""){
$hatasayac++;$hatalar.=$hatasayac." : ".$yazi."<br>";}
return array($hatasayac,$hatalar);}
function epo($eposta){
return (preg_match('/\\b[A-Z0-9._%-]+@[A-Z0-9._%-]+\\.[A-Z]{2,4}\\b/i', $eposta)) ? true : false;}
function turkce($tck)
          {			$tck=str_replace("ı","I",$tck);
                    $tck=str_replace("i","İ",$tck);
                    $tck=str_replace("ü","Ü",$tck);
                    $tck=str_replace("ö","Ö",$tck);
                    $tck=str_replace("ş","Ş",$tck);
                    $tck=str_replace("ğ","Ğ",$tck);
                    $tck=str_replace("ç","Ç",$tck);
            return $tck;
}
function formgoster($hatalar){ 
	global $adsoyad,$adres,$telefon,$eposta,$gorus,$hatalar;
 ?>
<form id="form1" name="form1" method="post" action="">
<table width="648" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="112" colspan="2"><div align="center"><strong>MADEN  ANALİZLERİ VE TEKNOLOJİSİ DAİRE BAŞKANLIĞI <br>
      MÜŞTERİ  MEMNUNİYETİ ANKETİ </strong>
      <br /></div>
      <div>
        <div align="justify">
          <p>&nbsp;</p>
          <p> Lütfen Aşağıdaki Formu Doldurduktan sonra <em>Gönder</em> tuşuna basınız.</span><br>    
            <br />
          </p>
        </div>
      </div>
    </td>
  </tr>
  <tr>
    <td height="21" colspan="2" align="left"><div align="center"><b> MÜŞTERİNİN</b></div></td>
    </tr>
  <tr> 
    <td width="157" height="24" align="left">Adı Soyadı</td>
    <td width="491"><input name="adsoyad" type="text" id="adsoyad" size="50" maxlength="100"  value="<? echo $adsoyad;?>"  ></td>
  </tr>
  <tr>
    <td height="24" align="left" valign="top" >Adres</td>
    <td><input name="adres" type="text" id="adi3" size="50" maxlength="100"  value="<?=$adres?>"></td>
  </tr>
  <tr>
    <td height="24" align="left" valign="top" > Telefon</td>
    <td><input name="telefon" type="text" id="adi2" size="50" maxlength="100"  value="<?=$telefon?>"></td>
  </tr>
  <tr>
    <td height="36" align="left" valign="top" >E-mail</td>
    <td>
        <input name="email" type="text" id="adi" size="50" maxlength="100"  value="<?=$eposta?>"></td>
  </tr>
  <tr>
    <td height="21" colspan="2" valign="left">1- Numune kabul işlemleri için kullanılan Başvuru Formları anlaşılır nitelikte mi?</td>
  </tr>
  <tr>
    <td height="16" colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="3%"><input type="radio" name="radio" id="radio2" value="Evet" /></td>
        <td width="15%">Evet</td>
        <td width="3%"><input type="radio" name="radio" id="radio3" value="Kısmen" /></td>
        <td width="20%">Kısmen</td>
        <td width="3%"><input type="radio" name="radio" id="radio" value="Hayır" /></td>
        <td width="56%">Hayır          </td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td height="21" colspan="2">2- Numune Kabul Birimi'nde çalışanların müşteri ile iletişimi uygun mu?</td>
  </tr>
  <tr>
    <td height="16" colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="3%"><input type="radio" name="radio1" id="radio13" value="Evet" /></td>
        <td width="15%">Evet</td>
        <td width="3%"><input type="radio" name="radio1" id="radio14" value="Kısmen" /></td>
        <td width="20%">Kısmen</td>
        <td width="3%"><input type="radio" name="radio1" id="radio15" value="Hayır" /></td>
        <td width="56%">Hayır </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="15" colspan="2">3- Başvuruda bulunmadan önce yapılan analiz/test(ler)le ilgili bilgilendirme yeterli mi?</td>
  </tr>
  <tr>
    <td height="16" colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="3%"><input type="radio" name="radio2" id="radio16" value="Evet" /></td>
        <td width="15%">Evet</td>
        <td width="3%"><input type="radio" name="radio2" id="radio17" value="Kısmen" /></td>
        <td width="20%">Kısmen</td>
        <td width="3%"><input type="radio" name="radio2" id="radio18" value="Hayır" /></td>
        <td width="56%">Hayır </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="15" colspan="2">4- Kurumun web sitesinde yer alan Analiz/Test ve Kalibrasyon Hizmet Kataloğu bilgilendirme yönünden yeterli mi?</td>
  </tr>
  <tr>
    <td height="16" colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="3%"><input type="radio" name="radio3" id="radio19" value="Evet" /></td>
        <td width="15%">Evet</td>
        <td width="3%"><input type="radio" name="radio3" id="radio20" value="Kısmen" /></td>
        <td width="20%">Kısmen</td>
        <td width="3%"><input type="radio" name="radio3" id="radio21" value="Hayır" /></td>
        <td width="56%">Hayır </td>
      </tr> 
    </table></td>
  </tr>
  <tr>
    <td height="15" colspan="2">5- Verilen hizmetler ile ilgili talep edildiğinde tatmin edici cevaplar alınabiliyor mu?</td>
  </tr>
  <tr>
    <td height="16" colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="3%"><input type="radio" name="radio4" id="radio22" value="Evet" /></td>
        <td width="15%">Evet</td>
        <td width="3%"><input type="radio" name="radio4" id="radio23" value="Kısmen" /></td>
        <td width="20%">Kısmen</td>
        <td width="3%"><input type="radio" name="radio4" id="radio24" value="Hayır" /></td>
        <td width="56%">Hayır </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="15" colspan="2">6- Yapılan analiz/testlerin çeşitliliği yeterli mi?</td>
  </tr>
  <tr>
    <td height="16" colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="3%"><input type="radio" name="radio5" id="radio25" value="Evet" /></td>
        <td width="15%">Evet</td>
        <td width="3%"><input type="radio" name="radio5" id="radio26" value="Kısmen" /></td>
        <td width="20%">Kısmen</td>
        <td width="3%"><input type="radio" name="radio5" id="radio27" value="Hayır" /></td>
        <td width="56%">Hayır </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="15" colspan="2">7-Analiz/Test ücretleri verilen  hizmete uygun mu?</td>
  </tr>
  <tr>
    <td height="16" colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="3%"><input type="radio" name="radio6" id="radio28" value="Evet" /></td>
        <td width="15%">Evet</td>
        <td width="3%"><input type="radio" name="radio6" id="radio29" value="Kısmen" /></td>
        <td width="20%">Kısmen</td>
        <td width="3%"><input type="radio" name="radio6" id="radio30" value="Hayır" /></td>
        <td width="56%">Hayır </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="15" colspan="2">8- Aldığınız hizmetlere yönelik  şikayetler dinleniyor ve zamanında çözümleniyor mu?</td>
  </tr>
  <tr>
    <td height="16" colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="3%"><input type="radio" name="radio7" id="radio31" value="Evet" /></td>
        <td width="15%">Evet</td>
        <td width="3%"><input type="radio" name="radio7" id="radio32" value="Kısmen" /></td>
        <td width="20%">Kısmen</td>
        <td width="3%"><input type="radio" name="radio7" id="radio33" value="Hayır" /></td>
        <td width="56%">Hayır </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="15" colspan="2">9-  Gizlilik, tarafsızlık,  dürüstlük ilkelerine özen gösteriliyor mu?</td>
  </tr>
  <tr>
    <td height="16" colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="3%"><input type="radio" name="radio8" id="radio34" value="Evet" /></td>
        <td width="15%">Evet</td>
        <td width="3%"><input type="radio" name="radio8" id="radio35" value="Kısmen" /></td>
        <td width="20%">Kısmen</td>
        <td width="3%"><input type="radio" name="radio8" id="radio36" value="Hayır" /></td>
        <td width="56%">Hayır </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="15" colspan="2">10- Aldığınız hizmetlerin (analiz/test ,danışmanlık vb.) güvenilir nitelikte olduğunu düşünüyor musunuz?</td>
  </tr>
  <tr>
    <td height="16" colspan="2"><table width="100%" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="3%"><input type="radio" name="radio9" id="radio37" value="Evet" /></td>
        <td width="15%">Evet</td>
        <td width="3%"><input type="radio" name="radio9" id="radio38" value="Kısmen" /></td>
        <td width="20%">Kısmen</td>
        <td width="3%"><input type="radio" name="radio9" id="radio39" value="Hayır" /></td>
        <td width="56%">Hayır </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="23" valign="top" >&nbsp;</td>
    <td height="23" valign="bottom" >&nbsp;</td>
  </tr>
  <tr>
    <td height="60">
      
      Görüş ve Önerileriniz:</td>
    <td height="60" valign="bottom" ><textarea name="gorus" cols="40" rows="3" id="gorus" ><?=$gorus?></textarea></td>
    </tr>
  <tr>
    <td height="21" colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25%" align="right" class="arial">Yandaki Alanı İşaretleyiniz</td>
        <td align="right" class="arial" colspan="2"><div class="g-recaptcha" data-sitekey="6LdIewkUAAAAADUwvUpNA08F0Js0v-_4Q99uLyvx"></div></td>
        <td width="33%" class="arial">
          <input type="submit" name="gonder" id="submit" value="Gönder" /></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="26" colspan="2" align="right">&nbsp;</td>
  </tr>
  <tr>
    <td height="26" colspan="2" align="center"><?=$hatalar;?></td>
  </tr>
</table>
</form>
<? 
}
if($_REQUEST["gonder"]=="Gönder"){
kepce_spam();
include('../../../iletisim/iptarih.php');
$dakka=1;
$time3=$tarihzaman-$dakka;
$tarih=strftime("%d/%m/%Y %H:%M");
include('../../../iletisim/mysqlconnect.php');
mysql_query("delete from kisi where time<$time3");
$varm=mysql_query("select * from kisi where ip='$apm' and sayfa='kalite'");
$varmi=mysql_fetch_array($varm);
if(mysql_num_rows($varm)>0)
{echo "<br><br><br><center>Yeni bir kaydı ".$dakka." dakika sonra yapabilirsiniz.<br><br></center>";
?> <center><a href="javascript:history.back(1)">&laquo;&laquo;&nbsp;GERİ</a></center>  <?  }
elseif ($_POST["gonder"]<>"Gönder") 
{echo formgoster();} else{

$adsoyad=strtoupper(turkce($_POST["adsoyad"]));
$adres=$_POST["adres"];
$telefon=$_POST["telefon"];
$eposta=$_POST["email"];
$gorus=$_POST["gorus"];
$radio=$_REQUEST["radio"];
$radio1=$_REQUEST["radio1"];
$radio2=$_REQUEST["radio2"];
$radio3=$_REQUEST["radio3"];
$radio4=$_REQUEST["radio4"];
$radio5=$_REQUEST["radio5"];
$radio6=$_REQUEST["radio6"];
$radio7=$_REQUEST["radio7"];
$radio8=$_REQUEST["radio8"];
$radio9=$_REQUEST["radio9"];

if(!epo($eposta)){hata("Hatalı E-posta girişi.Tekrar deneyiniz");}}

if($adsoyad==""  or $eposta==""  or $_REQUEST["guvenlik"]<>""){hata("$adsoyad,$eposta -Doldurulması zorunlu alan boş.Tekrar deneyiniz.");}


if(!(kol($adsoyad) and kol($adres) and kol($telefon) and kol($gorus) and kol($eposta) and kol($radio)  and kol($radio1)  and kol($radio2)  and kol($radio3)  and kol($radio4)  and kol($radio5)  and kol($radio6)  and kol($radio7)  and kol($radio8)  and kol($radio9)))
{hata("Forma hatalı veri girişi.Tekrar deneyiniz.");}

//if($_REQUEST["guvenlik"]!=$_SESSION["sifre_session"] and $_REQUEST["guvenlik"]!=""){hata("Güvenlik kodunu yanlış girdiniz.");}
list($hatasayac,$hatalar)=hata();

if($hatasayac>=1){echo formgoster($hatalar);}else
{ 
$bilgi='
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Mail</title>
</head>
<body>
<table width="800" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="36" colspan="2" align="left"><b>Müşterinin</b></td>
  </tr>
  <tr>
    <td width="93" height="24" align="left">&nbsp;Adı Soyadı</td>
    <td width="507">: '.$adsoyad.'</td>
  </tr>
  <tr>
    <td width="93" height="24" align="left">&nbsp;Tarih</td>
    <td width="507">: '.$tarih.'</td>
  </tr>

  <tr>
    <td width="93" height="24" align="left">&nbsp;Adres</td>
    <td width="507">: '.$adres.'</td>
  </tr>
  <tr>
    <td width="93" height="24" align="left">&nbsp;Telefon</td>
    <td width="507">: '.$telefon.'</td>
  </tr>
  <tr>
    <td width="93" height="24" align="left">&nbsp;Email</td>
    <td width="507">: '.$eposta.'</td>
  </tr>
   <tr>
    <td width="93" height="24" align="left">&nbsp;Tarih ve Ip Adresi</td>
    <td width="607">: '.$time."--".$apm.'</td>
  </tr>
  '; if(isset($radio)){$bilgi.='  
  <tr>  
    <td height="30" colspan="2" valign="left">1- Başvuruda bulunmadan önce  yapılan analiz/testle ilgili bilgilendirme yeterli mi? '.$radio.'</td>
  </tr>
   ';}; if(isset($radio1)){$bilgi.='
  <tr>
    <td height="30" colspan="2">2- Verilen hizmetler ile ilgili  bilgi talep edildiğinde tatmin edici cevaplar alınabiliyor mu? '.$radio1.'</td>
  </tr>
   ';}; if(isset($radio2)){$bilgi.='
  <tr>
    <td height="30" colspan="2">3- Numune Kabul işlemleri ve  verilen hizmet etkin mi? '.$radio2.'</td>
  </tr>
   ';}; if(isset($radio3)){$bilgi.='
  <tr>
    <td height="30" colspan="2">4- Gizlilik, tarafsızlık,  dürüstlük ilkelerine özenzen gösteriliyor mu? '.$radio3.'</td>
  </tr>
 ';}; if(isset($radio4)){$bilgi.='
  <tr>
    <td height="30" colspan="2">5- Analiz/Test ücretleri verilen  hizmete uygun mu? '.$radio4.'</td>
  </tr>
   ';}; if(isset($radio5)){$bilgi.='
  <tr>
    <td height="30" colspan="2">6- Analiz/Test işlemleri  belirtilen zaman içinde tamamlanıyor mu? '.$radio5.'</td>
  </tr>
   ';}; if(isset($radio6)){$bilgi.='
  <tr>
    <td height="30" colspan="2">7- Çalışanların müşteriyle  iletişimi uygun mu? '.$radio6.'</td>
  </tr>
   ';}; if(isset($radio7)){$bilgi.='
  <tr>
    <td height="30" colspan="2">8- Aldığınız hizmetlere yönelik  şikayetler dinleniyor ve zamanında çözümleniyor mu? '.$radio7.'</td>
  </tr>
   ';}; if(isset($radio8)){$bilgi.='
  <tr>
    <td height="30" colspan="2">9- Yapılan analiz/testlerin çeşitliliği  yeterli mi? '.$radio8.'</td>
  </tr>
   ';}; if(isset($radio9)){$bilgi.='
  <tr>
    <td height="30" colspan="2">10- Verilen hizmetler güvenilir  nitelikte mi? '.$radio9.'</td>
  </tr>';};
  $bilgi.='<tr>
    <td height="69" align="center">Görüş ve önerileriniz<b>:</b> </td>
    <td height="69">'.$gorus.'</td>
  </tr>
</table>
</body>
</html>';
 
date_default_timezone_set('Etc/UTC');
require '/var/www/html/v3.0/mail_gonder/PHPMailerAutoload.php';
$mail = new PHPMailer;
$mail->CharSet = 'UTF-8';
$mail->isSMTP();
$mail->SMTPDebug = 0;
$mail->Debugoutput = 'html';
$mail->Host = "posta.mta.gov.tr";
$mail->Port = 587;
$mail->SMTPAuth = true;
$mail->Username = "kalite@mta.gov.tr";
$mail->Password = "Yon.Sis.2018";
$mail->setFrom('kalite@mta.gov.tr', 'Gönderen Kişi');
$mail->addAddress('kalite@mta.gov.tr', 'Alıcı Kişi');
$mail->Subject = 'Müşteri Memnuniyeti Anketi';
$mail->msgHTML($body);
$mail->Body.=$bilgi;

//send the message, check for errors
if (!$mail->send()) {
    echo "Mesajınız Gönderilemedi.!" . $mail->ErrorInfo;
} else {
    echo '<div align="center"><span class="style6">
      <p><b class="style2">Bilgileriniz kayıtlarımıza alınmıştır. </b></p>
      <p><b class="style2">Anketimize katıldığınız ve değerli önerilerinizi bizimle paylaştığınız için teşekkür ederiz.<br />
        </p>
    </div>';
session_destroy();
} } }else{echo formgoster();}
?> 





 

	</div><!-- #wrapper -->
    </div>
	
    <!--Scripts-->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="js/ace-responsive-menu.js" type="text/javascript"></script>
	
	<!--Plugin Initialization-->
     <script type="text/javascript">
         $(document).ready(function () {
             $("#respMenu").aceResponsiveMenu({
                 resizeWidth: '768', // Set the same in Media query       
                 animationSpeed: 'fast', //slow, medium, fast
                 accoridonExpAll: false //Expands all the accordion menu on click
             });
         });
	</script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>


</body>
</html>
