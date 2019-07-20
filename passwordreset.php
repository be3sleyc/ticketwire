<?php
 session_start();
 $source = filter_input(INPUT_GET, 'source');
 $userID = '';
 if ( ISSET($_SESSION['UserID']) ) {
    $userID = $_SESSION['UserID'];
 } elseif( ISSET($_GET['userid']) ) {
    $userID = filter_input(INPUT_GET, 'userid');
 }
?>