function Loading(Place, Message)
{
	$(Place).html('<div style="background:url(img/saydam_siyah.png); position:fixed;top:0;left:0; width:100%;height:100%;z-index:999"></div><div style="position:fixed;top:40%;left:40%; width:100%;height:100%;z-index:999"><img src="img/ajax-loaders/my_loading.gif" width="250" height="250"><br><div style="color:#000; margin-left:65px; font-size:22px;">'+Message+'</div></div>');
}
/* Login Fonksiyonu */
function SettingsEdit(ID) {
	Loading("#SettingsResult", "İşleminiz Devam Ediyor, Lütfen Bekleyiniz...");
    var str = $("form#SettingsForm").serialize();
    $.ajax({
        data: str + '&ID='+ID+'&func=Settings',
        type: 'POST',
        cache: false,
        url: 'ajax/Settings/SettingsEdit.php',
        success: function (ajaxAnswer) {
				$("#SettingsResult").html(ajaxAnswer);
        }
    })
}
// GeneralDelete
function GeneralImagesDelete(Place, Tables, ID)
{
    //LoadingFacebook("#"+Place, "");
    var str = 'Place='+Place+'&Tables='+Tables+'&ID='+ID;
    $.ajax({
        data: str+'&func=GeneralDelete',
        type: 'POST',
        cache: false,
        url: 'ajax/GeneralDelete/GeneralImagesDelete.php',
        success: function(ajaxAnswer) {
            $("#"+Place).hide();
        }
     });
}

function GalleryDelete(Place, Tables, ID)
{
    //LoadingFacebook("#"+Place, "");
    var str = 'Place='+Place+'&Tables='+Tables+'&ID='+ID;
    $.ajax({
        data: str+'&func=GalleryDelete',
        type: 'POST',
        cache: false,
        url: 'ajax/GeneralDelete/GalleryDelete.php',
        success: function(ajaxAnswer) {
            $("#"+Place).hide();
        }
     });
}
function SurveyFieldsGet(SurveyID)
{
    //LoadingFacebook("#"+Place, "");
    var str = $("form#SurveyQuestionsForm").serialize();
    $.ajax({
        data: str+'&func=SurveyQuantity',
        type: 'POST',
        cache: false,
        url: 'ajax/SurveyQuantity/SurveyFieldsGet.php',
        success: function(ajaxAnswer) {
            $("#SurveyFieldsGetPlace").html(ajaxAnswer);
        }
     });
}
function SurveyQuantity_SurveyFieldsGet(SurveyID)
{
    //LoadingFacebook("#"+Place, "");
    var str = $("form#SurveyQuantityForm").serialize();
    $.ajax({
        data: str+'&func=SurveyQuantity',
        type: 'POST',
        cache: false,
        url: 'ajax/SurveyQuantity/SurveyQuantity_SurveyFieldsGet.php',
        success: function(ajaxAnswer) {
            $("#SurveyQuantity_SurveyFieldsGetPlace").html(ajaxAnswer);
        }
     });
}
function SurveyQuantity_SurveyQuestionsGet(SurveyID)
{
    //LoadingFacebook("#"+Place, "");
    var str = $("form#SurveyQuantityForm").serialize();
    $.ajax({
        data: str+'&func=SurveyQuantity',
        type: 'POST',
        cache: false,
        url: 'ajax/SurveyQuantity/SurveyQuantity_SurveyQuestionsGet.php',
        success: function(ajaxAnswer) {
            $("#SurveyQuantity_SurveyQuestionsGetPlace").html(ajaxAnswer);
        }
     });
}