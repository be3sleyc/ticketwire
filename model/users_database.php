<?php
require('database_connection.php');

function login($email, $password) {
    global $connection;
    $user = '';
    // check if account is locked before logging in
    if (checkLockStatus($email)) {
        return 'Locked';
    }
    $query = "EXEC uspLogIn @email = ?, @password = ?";
    $params = array( $email, $password );
    $statement = sqlsrv_query( $connection, $query, $params );
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $user = sqlsrv_fetch_array( $statement );
    
    return $user;
}

function checkLockStatus($email) {
    global $connection;
    $locked = null;
    $query = "EXEC uspCheckLock @email = ?";
    $params = array( $email );
    $statement = sqlsrv_query( $connection, $query, $params );
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $locked = sqlsrv_fetch_array( $statement );
    return $locked[0];
}

function unlockAccount($email) {
// TODO
}

function get_users() {
    global $connection;
    $users = array();
    $query = "EXEC uspFetchAllUsers;";
    $statement = sqlsrv_query( $connection, $query );
    
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    while ( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_ASSOC ) ) {
        array_push($users, $row);
    }

    return $users;
}

function get_user($email) {
    global $connection;
    $user = '';
    $query = "EXEC uspFetchUser @email = ?";
    $params = array( $email );
    $statement = sqlsrv_query( $connection, $query, $params );
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $user = sqlsrv_fetch_array( $statement );
    return $user;
}

function get_UserRoles() {
    global $connection;
    $roles = array();
    $query = "EXEC uspFetchRoles";
    $statement = sqlsrv_query( $connection, $query );
    
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    while ( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_ASSOC ) ) {
        array_push($roles, $row);
    }

    return $roles;
}

function getCustomers() {
    global $connection;
    $customers = array();
    $query = "EXEC uspFetchCustomers";
    $statement = sqlsrv_query( $connection, $query );
    
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    while ( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_ASSOC ) ) {
        array_push($customers, $row);
    }

    return $customers;
}

function getTechnicians() {
    global $connection;
    $technicians = array();
    $query = "EXEC uspFetchTechnicians";
    $statement = sqlsrv_query( $connection, $query );
    
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    while ( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_ASSOC ) ) {
        array_push($technicians, $row);
    }

    return $technicians;
}

function getCustomer($UserID) {
    global $connection;
    $customer = null;
    $query = "EXEC uspFetchCustomer @UserID = ?";
    $params = array( $UserID );
    $statement = sqlsrv_query( $connection, $query, $params );
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $customer = sqlsrv_fetch_array( $statement );
    return $customer;
}

function getTechnician($UserID) {
    global $connection;
    $technician = null;
    $query = "EXEC uspFetchTechnician @UserID = ?";
    $params = array( $UserID );
    $statement = sqlsrv_query( $connection, $query, $params );
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $technician = sqlsrv_fetch_array( $statement );
    return $technician;
}

function editAccount($UserID, $firstName, $lastName, $email, $phone) {
    global $connection;
    $message = 'notset';
    $phone = preg_replace('/[+-]/','',$phone);
    $query = "EXEC uspEditUser @UserID = ?, @FirstName = ?, @LastName = ?, @EmailAddress = ?, @PhoneNumber = ?";
    $params = array($UserID, $firstName, $lastName, $email, $phone);
    $statement = sqlsrv_query( $connection, $query, $params );
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $updatedRows = sqlsrv_rows_affected($statement);
    
    if ( $updatedRows >= 1 ) {
        $message = 'Account updated successfully';
    } else {
        $message = 'Error updating account';
    }

    return $message;
}

function editCustomer($UserID) {
// TODO
}

function editTechnician($UserID) {
// TODO
}

function disableAccount($UserID) {
// TODO
}

function enableAccount($UserID) {
// TODO
}
?>