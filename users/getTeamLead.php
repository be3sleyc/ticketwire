<?php 
include '../model/users_database.php';
$TeamLead = null;

if( ISSET($_POST['TeamID']) ) {
    $TeamID = filter_input(INPUT_POST, 'TeamID');
    $TeamLead = getTeamLead($TeamID);
} 

if($TeamLead !== null) {
    echo $TeamLead['Name'];
}
?>