<?php 
	include '../../Controller.php';
	
	include '../../'.Defined::PATH_CLASS.'Survey.php';
	
	$SurveyFieldsID = intval($_POST['SurveyFieldsID']);
	$Survey = new Survey();

	$lineSurveyQuestionsGet = $Survey->SurveyQuestionsGet($SurveyFieldsID);
?>

	<select class="form-control" id="SurveyQuestionsID" name="SurveyQuestionsID"  data-rel="chosen">
		<option>Seçiniz</option>
	<?php
		foreach($lineSurveyQuestionsGet as $lineSurveyQuestionsGet)
		{
	?>
			<option value="<?php echo $lineSurveyQuestionsGet->ID; ?>">
				<?php echo $lineSurveyQuestionsGet->Name; ?>
			</option>
	<?php 
		}
	?>
	</select>
	