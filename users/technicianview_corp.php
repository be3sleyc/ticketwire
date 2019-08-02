<?php 
    $skills = getSkills();
    $teams = getTeams();
?>

<h3>Technician Information</h3>
<input type="hidden" name="roleAction" value="CorpUpdateTech">
<?php $technicianInfo = getTechnician($lookup_user['UserID']);?>
<label for="HiredOn">Hired on <?=$technicianInfo['HireDate'];?></label><br>
<label for="birthDate">Birthdate:&nbsp;<?=$technicianInfo['BirthDate'];?></label><br>
<label for="skill">Skill:&nbsp;</label>
<select name="SkillID" id="SkillID">
    <?php foreach ($skills as $skill): ?>
        <?php if( $skill['SkillDesc'] == $technicianInfo['SkillDesc']):?>
            <option value="<?=$skill['SkillLevel']?>" selected><?=$skill['SkillDesc'];?></option>
        <?php else:?>
        <option value="<?=$skill['SkillLevel']?>"><?=$skill['SkillDesc'];?></option>
        <?php endif;?>
    <?php endforeach;?>
</select><br>
<label for="TeamID">Team:&nbsp;</label>
<select name="TeamID" id="TeamID" onchange="updateRegionName(this.value)">
    <?php foreach ($teams as $team): ?>
        <?php if( $team['RegionID'] == $technicianInfo['TeamID'] ):?>
            <option value="<?=$team['RegionID'];?>" selected><?=$team['RegionID'] . '-' . $team['RegionName'];?></option>
        <?php else:?>
            <option value="<?=$team['RegionID'];?>"><?=$team['RegionID'] . '-' . $team['RegionName'];?></option>
        <?php endif;?>
    <?php endforeach;?>
</select><br>
<label for="regionName">Region:&nbsp;<span id="RegionName"><?=$technicianInfo['RegionName']?></span></label><br>
<label for="TeamLead">Team Lead:&nbsp;<span id="TeamLead"><?=getTeamLead($technicianInfo['TeamID'])['Name']?></span></label>
<?php //RegionName and TeamLead depend on what teamID is selected?>
