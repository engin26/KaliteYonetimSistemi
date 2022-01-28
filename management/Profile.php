<!DOCTYPE html>
<html lang="en">
<head>
     <?php

        error_reporting(0);
        ini_set("display_errors", 0);
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
		if(isset($_POST['b1']) && $_POST['b1'] == 1)
		{
			$Users = new Users();
			$Users->LoginControl($_POST['Email'], $_POST['Password']);
		}

        if(isset($_GET['auto_login']) == 1 && $_SESSION['UserID'] != '')
        {
            $Users = new Users();
            $Users->AutoLogin($_SESSION['UserID'], $_SESSION['Password']);
        }
		if($_SESSION['userID'] == '' && $_SESSION['loggedin'] == '')
		{
			header("Location:index.php");
		}
	?>
   
    <meta charset="UTF-8">
    <title><?php echo $lineSettings->Title; ?></title>
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
    <link href='css/custom.css' rel='stylesheet'>
	
	<!-- validationEngine start -->
	<link rel="stylesheet" href="plugins/ValidationEngine/css/validationEngine.jquery.css" type="text/css"/>
	<!-- validationEngine finish -->
	
    <!-- jQuery -->
	<script src="plugins/ValidationEngine/js/jquery-1.8.2.min.js" type="text/javascript"></script>
    <script src="bower_components/jquery/jquery.min.js"></script>

    <!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- The fav icon -->
    <link rel="shortcut icon" href="img/favicon.ico">
	<!-- confirm -->
	<link rel="stylesheet" type="text/css" href="plugins/confirm/css/styles.css" />
	<link rel="stylesheet" type="text/css" href="plugins/confirm/jquery.confirm/jquery.confirm.css" />
	<script src="plugins/confirm/js/jquery.min.js"></script>
	<script src="plugins/confirm/jquery.confirm/jquery.confirm.js"></script>
	<script src="plugins/confirm/js/script.js"></script>
	<!--  confirm finish -->
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
    <script src="js/my_jquery.js"></script>
    <!-- validationEngine -->
    <script src="plugins/ValidationEngine/js/languages/jquery.validationEngine-tr.js" type="text/javascript" charset="utf-8"></script>
    <script src="plugins/ValidationEngine/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

      <!-- <script src="plugins/tinymce/plugins/moxiemanager/js/moxman.loader.min.js"></script>-->
    	 <!--<script type="text/javascript" src="plugins/tinymce/tinymce.min.js"></script>-->
    	<script type="text/javascript">
    	/*tinymce.init({
    	width : 800,
    		selector: "#Content",
    		theme: "modern",
    		language : 'tr',
    		plugins: [
    			"advlist autolink lists link image charmap print preview hr anchor pagebreak",
    			"searchreplace wordcount visualblocks visualchars code fullscreen",
    			"insertdatetime media nonbreaking save table contextmenu directionality",
    			"emoticons template paste textcolor moxiemanager"
    		],
    		toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
    		toolbar2: "print preview media | forecolor backcolor emoticons",
    		image_advtab: true,
    		templates: [
    			{title: 'Test template 1', content: 'Test 1'},
    			{title: 'Test template 2', content: 'Test 2'}
    		]
    		
    	});*/
    	
    	</script>
    	<!-- CK Editor -->
    	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
    	<script type="text/javascript" src="ckeditor/sample.js"></script>

        <link rel="stylesheet" href="plugins/DatetimePicker/css/jquery-ui.css">
        <script src="plugins/DatetimePicker/js/jquery-ui.js"></script>
        
      
</head>

<body>
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner">
            <button type="button" class="navbar-toggle pull-left animated flip">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="http://www.mta.gov.tr/ucretli-isler/liste/test-ve-analizler/test/management/Profile.php">
                <span>Ana Sayfa</span></a>
          <a class="navbar-brand" target="blank" href="http://www.mta.gov.tr/ucretli-isler/liste/test-ve-analizler/test/index.php">
                <span>Siteye Git</span></a>
                <a class="navbar-brand" href="index.php?func=Logout">
                <span>Çıkış Yap</span></a>

           
            <!-- user dropdown ends -->

            <!-- theme selector starts -->
            <!--<div class="btn-group pull-right theme-container animated tada">
                <button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <i class="glyphicon glyphicon-tint"></i><span
                        class="hidden-sm hidden-xs"> Change Theme / Skin</span>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" id="themes">
                    <li><a data-value="classic" href="#"><i class="whitespace"></i> Classic</a></li>
                    <li><a data-value="cerulean" href="#"><i class="whitespace"></i> Cerulean</a></li>
                    <li><a data-value="cyborg" href="#"><i class="whitespace"></i> Cyborg</a></li>
                    <li><a data-value="simplex" href="#"><i class="whitespace"></i> Simplex</a></li>
                    <li><a data-value="darkly" href="#"><i class="whitespace"></i> Darkly</a></li>
                    <li><a data-value="lumen" href="#"><i class="whitespace"></i> Lumen</a></li>
                    <li><a data-value="slate" href="#"><i class="whitespace"></i> Slate</a></li>
                    <li><a data-value="spacelab" href="#"><i class="whitespace"></i> Spacelab</a></li>
                    <li><a data-value="united" href="#"><i class="whitespace"></i> United</a></li>
                </ul>
            </div>-->
            <!-- theme selector ends -->
            </ul>

        </div>
    </div>
    <!-- topbar ends -->
<div class="ch-container">
    <div class="row">
        
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <?php include 'Menu.php'; ?>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
		<?php
			$func = $_GET['func'];
			if($func == '') header("Location:".  Defined::PROFILE."?func=DATETIME");
			if($func == null) header("Location:".  Defined::PROFILE."?func=DATETIME");
			switch($func)
			{
				case "$func":
				{
					include Defined::PATH_PAGES.$func.'/index.php';
				}
				break;
			}
		?>
		<!-- content ends -->
		</div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

       <hr>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="row">
     
    </footer>

</div><!--/.fluid-container-->

<!-- external javascript -->

      <!-- Add jQuery library -->

        <!-- Add mousewheel plugin (this is optional) -->
        <script type="text/javascript" src="plugins/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

        <!-- Add fancyBox main JS and CSS files -->
        <script type="text/javascript" src="plugins/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
        <link rel="stylesheet" type="text/css" href="plugins/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />

        <!-- Add Button helper (this is optional) -->
        <link rel="stylesheet" type="text/css" href="plugins/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
        <script type="text/javascript" src="plugins/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

        <!-- Add Thumbnail helper (this is optional) -->
        <link rel="stylesheet" type="text/css" href="plugins/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
        <script type="text/javascript" src="plugins/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

        <!-- Add Media helper (this is optional) -->
        <script type="text/javascript" src="plugins/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            /*
             *  Simple image gallery. Uses default settings
             */

            $('.fancybox').fancybox();

            /*
             *  Different effects
             */

            // Change title type, overlay closing speed
            $(".fancybox-effects-a").fancybox({
                helpers: {
                    title : {
                        type : 'outside'
                    },
                    overlay : {
                        speedOut : 0
                    }
                }
            });

            // Disable opening and closing animations, change title type
            $(".fancybox-effects-b").fancybox({
                openEffect  : 'none',
                closeEffect : 'none',

                helpers : {
                    title : {
                        type : 'over'
                    }
                }
            });

            // Set custom style, close if clicked, change title type and overlay color
            $(".fancybox-effects-c").fancybox({
                wrapCSS    : 'fancybox-custom',
                closeClick : true,

                openEffect : 'none',

                helpers : {
                    title : {
                        type : 'inside'
                    },
                    overlay : {
                        css : {
                            'background' : 'rgba(238,238,238,0.85)'
                        }
                    }
                }
            });

            // Remove padding, set opening and closing animations, close if clicked and disable overlay
            $(".fancybox-effects-d").fancybox({
                padding: 0,

                openEffect : 'elastic',
                openSpeed  : 150,

                closeEffect : 'elastic',
                closeSpeed  : 150,

                closeClick : true,

                helpers : {
                    overlay : null
                }
            });

            /*
             *  Button helper. Disable animations, hide close button, change title type and content
             */

            $('.fancybox-buttons').fancybox({
                openEffect  : 'none',
                closeEffect : 'none',

                prevEffect : 'none',
                nextEffect : 'none',

                closeBtn  : false,

                helpers : {
                    title : {
                        type : 'inside'
                    },
                    buttons : {}
                },

                afterLoad : function() {
                    this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
                }
            });


            /*
             *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
             */

            $('.fancybox-thumbs').fancybox({
                prevEffect : 'none',
                nextEffect : 'none',

                closeBtn  : false,
                arrows    : false,
                nextClick : true,

                helpers : {
                    thumbs : {
                        width  : 50,
                        height : 50
                    }
                }
            });

            /*
             *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
            */
            $('.fancybox-media')
                .attr('rel', 'media-gallery')
                .fancybox({
                    openEffect : 'none',
                    closeEffect : 'none',
                    prevEffect : 'none',
                    nextEffect : 'none',

                    arrows : false,
                    helpers : {
                        media : {},
                        buttons : {}
                    }
                });

            /*
             *  Open manually
             */

            $("#fancybox-manual-a").click(function() {
                $.fancybox.open('1_b.jpg');
            });

            $("#fancybox-manual-b").click(function() {
                $.fancybox.open({
                    href : 'iframe.html',
                    type : 'iframe',
                    padding : 5
                });
            });

            $("#fancybox-manual-c").click(function() {
                $.fancybox.open([
                    {
                        href : '1_b.jpg',
                        title : 'My title'
                    }, {
                        href : '2_b.jpg',
                        title : '2nd title'
                    }, {
                        href : '3_b.jpg'
                    }
                ], {
                    helpers : {
                        thumbs : {
                            width: 75,
                            height: 50
                        }
                    }
                });
            });


        });
    </script>

	
</body>
</html>

<!--
<script>
        jQuery(document).ready(function(){
            jQuery("#formID").validationEngine();

            $("#formID").bind("jqv.field.result", function(event, field, errorFound, prompText){ console.log(errorFound) })
        });
    </script>
</head>
<body>
    <p>
        <a href="#" onclick="alert(jQuery('#formID').validationEngine({evaluate:true}))">Return true or false without binding anything</a>
        | <a href="#" onclick="jQuery.validationEngine.buildPrompt('#formID','This is an example','error')">Build a prompt on a div</a>
        | <a href="#" onclick="jQuery.validationEngine.loadValidation('#date')">Load validation date</a>
        | <a href="#" onclick="jQuery.validationEngine.closePrompt('.formError',true)">Close all prompt</a>
        | <a href="../index.html" onclick="">Back to index</a>
    </p>    
    <p style="color:red; text-align:center">Please run this demo from a WebServer, it will fail otherwise.
    </p>
    <p>
        This demonstrations shows the use of inline Ajax validations. The inline ajax validation is never fired on submit.
        <br/>
        The form validation implements callback hooks, so please check the javascript console
    </p>
    <form id="formID" class="formular" method="post" action="" style="width:600px">
        <fieldset>
            <legend>
                Ajax validation
            </legend>
            <label>
                <span>Desired username (ajax validation, only <b>karnius</b> is available) : </span>
                <input value="" class="validate[required,custom[onlyLetterNumber],maxSize[20],ajax[ajaxUserCallPhp]] text-input" type="text" name="user" id="user" />
                <p>
                    validate[required,custom[noSpecialCaracters],maxSize[20],ajax[ajaxUserCall]]
                </p>
            </label>
            <label>
                <span>First name (ajax validation, only <b>duncan</b> is available): </span>
                <input value="" class="validate[optional,custom[onlyLetterSp],maxSize[100],ajax[ajaxNameCallPhp]] text-input" type="text" name="firstname" id="firstname" />
                <p>
                    validate[custom[onlyLetterSp],length[0,100],ajax[ajaxNameCall]]
                </p>
            </label>
            <label>
                <span>Email address : </span>
                <input value="" class="validate[required,custom[email]] text-input" type="text" name="email" id="email" />
                <p>
                    validate[required,custom[email]]
                </p>
            </label>
        </fieldset>
        <input class="submit" type="submit" value="Validate &amp; Send the form!"/><hr/>
    </form>
</body>
</html>-->