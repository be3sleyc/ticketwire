<?php 
include '../model/users_database.php';
$technician = null;
if( isset($_POST['UserID']) ) {
    $userID = filter_input(INPUT_POST, 'UserID', FILTER_VALIDATE_INT);
    $technician = getTechnician($userID);
}

$pattern = '/(\w{3})(\w{3})(\w{4})/';
$replace = '($1)$2-$3';

if($technician !== null) {
    echo "<label for='technicianTeamRegion'>Team - Region:&nbsp;" . ($technician['TeamID'] . " - " .  $technician['RegionName']) . "</label><br>";
    echo "<label for='technicianTeamLead'>Team Lead:&nbsp;" . $technician['TeamLead'] ."</label><br>";
    echo "<label for='technicianSkill'>Skill:&nbsp;". $technician['SkillDesc'] . "</label><br>";
}
?>