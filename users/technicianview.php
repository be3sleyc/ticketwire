<h3>Technician Information</h3>
<input type="hidden" name="roleAction" value="UpdateTech">
<?php $technicianInfo = getTechnician($_SESSION['user_id']);?>
<label for="HiredOn">Hired on <?=$technicianInfo['HireDate'];?></label><br>
<label for="birthDate">Birthdate:&nbsp;<?=$technicianInfo['BirthDate'];?></label><br>
<label for="skill">Skill:&nbsp;<?=$technicianInfo['SkillDesc'];?></label><br>
<label for="TeamID">Team:&nbsp;<?=$technicianInfo['TeamID'];?></label><br>
<label for="TeamLead">Team Lead:&nbsp;<span id="TeamLead"><?=getTeamLead($technicianInfo['TeamID'])['Name']?></span></label>