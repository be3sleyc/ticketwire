<?php
// TODO these can't be hard coded when we ship
    $dbName = 'ticketwire_db';
    $username = 'tw_dbuser';
    $password = 'pass';
    $server = 'INFO4430-TI-DEV';
    $instanceName = 'MSSQLSERVER';
    $serverName = "INFO4430-TI-DEV\MSSQLSERVER"; //serverName\instanceName
    $connectionInfo = array( "Database"=>"ticketwire_db", "UID"=>"tw_dbuser", "PWD"=>"pass");
    $connection = sqlsrv_connect( $serverName, $connectionInfo);
  
    if( $connection ) {
        echo "Connection established.<br />";
   }else{
        echo "Connection could not be established.<br />";
        die( print_r( sqlsrv_errors(), true));
   }
?>