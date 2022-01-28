<!DOCTYPE html>
<html lang="en"><head>


<?php
 /*
if (!$link = mysql_connect('localhost', 'ucretli_isler', 'isler64mta21-')) {
    echo 'mysql\'e bağlanamadı';
    exit;
}

if (!mysql_select_db('ucretli_isler', $link)) {
    echo 'Veritabanını seçemedi';
    exit;
}

$sql    = 'SELECT * FROM gallery ';
//$sql    = 'SELECT * FROM flatpages ';
echo 'sql sorgu sonucu :  ';
$result = mysql_query($sql, $link);
mysql_query("update gallery set  images='1537211363_399237.jpg' where id=4");
mysql_query("SELECT * FROM gallery");
//images='1537534775_514244.jpg'

if (!$result) {
    echo "Veritabanı hatası, veritabanını sorgulayamıyor\n";
    echo 'MySQL Hatası: ' . mysql_error();
	
    exit;
}

while ($row = mysql_fetch_assoc($result)) {
    
	echo $row['ID'];echo $row['Name'];echo $row['Images'];
}

mysql_free_result($result);

*/

?>



    <?php
		error_reporting(E_ALL);
		include 'Class/System/index.php'; 
		if(isset($_GET['func']) && $_GET['func'] == 'Logout')
		{
			
			$_SESSION = array();
			session_destroy();
		}
		
		/* Sistemde Bulunan Site Ayarlarını Çeker */
		
		Model::load("Settings");
		
		$Settings = new Settings();
		$lineSettings = $Settings->SettingsList(1);
		
	?>
    <meta charset="UTF-8">
    <title>Ücretli İşler</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $lineSettings->Description; ?>">
    <meta name="author" content="<?php echo $lineSettings->Author; ?>">

    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">

    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>

    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">

</head>

<body>
<div class="ch-container">
    <div class="row">
        
    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>Yönetim Paneline Hoşgeldiniz</h2>
            <p>By Design Engin DALMIŞ</p>
        </div>
        <!--/span-->
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-5 center login-box">
            <div class="alert alert-info">
                Kullanıcı Adı ve Şifrenizi Giriniz
            </div>
            <form class="form-horizontal" action="<?php echo Defined::PROFILE ?>" method="POST">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="text" class="form-control" name="Email" placeholder="E-mail">
                    </div>
                    <div class="clearfix"></div><br>

                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" name="Password" placeholder="Şifre">
                    </div>
                    <div class="clearfix"></div>

                   <div class="clearfix"></div>

                    <p class="center col-md-5">
                        <button type="submit" name="b1" value="1" class="btn btn-primary">Giriş Yap</button>
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->

</div><!--/.fluid-container-->

<!-- external javascript -->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='bower_components/moment/min/moment.min.js'></script>
<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>


</body>
</html>
