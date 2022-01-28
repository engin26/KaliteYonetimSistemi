<?php
  include 'config.php';
  include 'functions.php';

  $lineSettings = SettingsList();
  $lineMainMenuList = MainMenuList();
  $lineContentCategoriesList  = ContentCategoriesList();
  /*<title><?php print $lineSettings->Title; ?></title>*/
?>
<!DOCTYPE html>
<html>

<head>
  <title>MAT-KYS</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">





<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
   <link href="css/ace-responsive-menu.css" rel="stylesheet" type="text/css" />
   <link href="css/flexslider.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="js/jquery-1.12.4.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="js/jquery.flexslider.js"></script>
  <script src="js/ace-responsive-menu.js" type="text/javascript"></script>

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/table_<?php print intval($_GET['cat_id']); ?>.css">

  <!--Plugin Initialization-->
     <script type="text/javascript">
         $(document).ready(function () {
             $("#respMenu").aceResponsiveMenu({
                 resizeWidth: '768', // Set the same in Media query
                 animationSpeed: 'fast', //slow, medium, fast
                 accoridonExpAll: false //Expands all the accordion menu on click
             });

             $(".flex-viewport").css({'height':'300px'});
         });
  </script>
 <script type="text/javascript">
   $(window).load(function() {
      $('.flexslider').flexslider({
        animation: "slide"
      });
    });
 </script>
<script type="text/javascript">
	$(document).ready(function(){
        //sayfa açıldığında otomatik açılması için
		$("#modalNesne").modal('show');
	});
</script>
</head>
<body>

  <div   style="margin-top:10px; margin-left:50px; margin-right:50px; max-width: 100%;max-height:1%; ">
    <div class="row" >
		<div class="col-lg-4 col-md-4 col-12" >
			<img src="images/bannerLeft.jpg" class="img-fluid" >
		</div>

		<div class="col-lg-4 col-md-4 col-12" >
			<img src="images/bannerCenter.jpg" class="img-fluid"  >
		</div>
		<div class="col-lg-4 col-md-4 col-12">
			<img src="images/bannerRight.jpg" class="img-fluid" >
		</div>

	</div>

	  <div class="row">
