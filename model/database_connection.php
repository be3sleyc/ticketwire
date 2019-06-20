<?php
// TODO these can't be hard coded when we ship
    $dbName = 'ticketwire_db';
    $dbUsername = 'tw_dbuser';
    $dbPassword = 'Pass';
    $server = 'INFO4430-TI-DEV';
    $connectionInfo = array( "Database"=>$dbName, "UID"=>$dbUsername, "PWD"=>$dbPassword );
    $connection = sqlsrv_connect( $server, $connectionInfo );
  
   if( !$connection ) {
       echo "Connection could not be established.<br />";
       die( print_r( sqlsrv_errors(), true));
  }
?>