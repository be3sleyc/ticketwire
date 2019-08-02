<?php 
include '../model/users_database.php';
$Region = null;

if( ISSET($_POST['ZipCode']) ) {
    $zipCode = filter_input(INPUT_POST, 'ZipCode');
    $Region = getRegionByZip($zipCode);
} elseif( ISSET($_POST['TeamID']) ) {
    $teamID = filter_input(INPUT_POST, 'TeamID');
    $Region = getRegionByTeam($teamID);
}

if($Region !== null) {
    echo $Region['RegionName'];
}
?>