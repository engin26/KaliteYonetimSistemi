<?php 
	include '../../Controller.php';
	
	include '../../'.Defined::PATH_CLASS.'Survey.php';
	
	$SurveyID = intval($_POST['SurveyID']);
	$Survey = new Survey();
	
	$lineSurveyFields = $Survey->SurveyFieldsGet($SurveyID);
	
?>

<select class="form-control" id="SurveyFieldsID" name="SurveyFieldsID" data-rel="chosen">
<?php 
	foreach($lineSurveyFields as $lineSurveyFields)
	{
?>
		<option value="<?php echo $lineSurveyFields->ID; ?>"><?php echo $lineSurveyFields->Name; ?></option>
<?php 
	}
?>
</select>

