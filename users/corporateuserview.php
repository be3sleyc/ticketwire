<h3>Corporate Information</h3>
<input type="hidden" name="roleAction" value="UpdateCorp">
<?php $corporateInfo = getCorporate($_SESSION['user_id']);?>
<label for="HiredOn">Hired on <?=$corporateInfo['HireDate'];?></label><br>
<label for="birthDate">Birthdate:&nbsp;<?=$corporateInfo['BirthDate'];?></label><br>
<label for="position">Position Title:&nbsp;<?=$corporateInfo['PositionTitle'];?></label>
