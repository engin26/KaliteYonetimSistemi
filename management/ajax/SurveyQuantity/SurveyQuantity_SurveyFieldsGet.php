<?php 
	include '../../Controller.php';
	
	include '../../'.Defined::PATH_CLASS.'Survey.php';
	
	$SurveyID = intval($_POST['SurveyID']);
	$Survey = new Survey();
	
	$lineSurveyFieldsGet = $Survey->SurveyFieldsGet($SurveyID);
?>
	
	<select class="form-control" id="SurveyFieldsID" name="SurveyFieldsID" onchange="SurveyQuantity_SurveyQuestionsGet();" data-rel="chosen">
		<option>Seçiniz</option>
	<?php
		foreach($lineSurveyFieldsGet as $lineSurveyFieldsGet)
		{
	?>
			<option value="<?php echo $lineSurveyFieldsGet->ID; ?>">
				<?php echo $lineSurveyFieldsGet->Name; ?>
			</option>
	<?php 
		}
	?>
	</select>
	