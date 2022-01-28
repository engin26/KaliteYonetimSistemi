<?php 
	include '../../Controller.php';
	
	include '../../'.Defined::PATH_CLASS.'Survey.php';
	
	$SurveyID = intval($_POST['SurveyID']);
	$Survey = new Survey();
	
	$lineSurveyQuantityGet = $Survey->SurveyQuantityGet($SurveyQuestionsID);
	
?>

	<select class="form-control" id="SurveyQuestionsID" name="SurveyQuestionsID" data-rel="chosen">
	<?php
		foreach($lineSurveyQuantityGet as $lineSurveyQuantityGet)
		{
	?>
			<option <?php $lineSurveyQuantityGet->ID == $lineSurveyQuantityGet[0]->SurveyQuestionsID ? print "selected":print ""; ?> value="<?php echo $lineSurveyQuantityGet->ID; ?>">
				<?php echo $lineSurveyQuantityGet->Name; ?>
			</option>
	<?php 
		}
	?>
	</select>
	