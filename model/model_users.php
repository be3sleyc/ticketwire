<?php
require('database_connection.php');

function get_user($email, $password) {
    global $connection;
    // TODO I need a where clause to get the only user I want. We can do email but have to ensure the email is unique
    // we can set the duplicate email catch as a trigger in the database and add a warning on the account creation page.
    $user = '';
    $query = "SELECT FirstName, LastName, EmailAddress, UserRole 
              FROM UserInfo 
              WHERE EmailAddress = ? AND Password = HASHBYTES('SHA2_512',?)";    
    $params = array( $email, $password );
    $statement = sqlsrv_query( $connection, $query, $params );
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $user = sqlsrv_fetch_array( $statement );
    return $user;
}

function get_users() {
    global $connection;
    $users = array();
    $query = "SELECT FirstName, LastName, EmailAddress, PhoneNumber, UserRole FROM UserInfo";
    $statement = sqlsrv_query( $connection, $query );
    
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    while ( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_ASSOC ) ) {
        array_push($users, $row);
    }

    return $users;
}