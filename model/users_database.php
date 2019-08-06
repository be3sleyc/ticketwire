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

function getLockedAccounts() {
    //TODO
}

function getUsers() {
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

function getUser($email) {
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

function getUserRoles() {
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

function getCorporates() {
    global $connection;
    $corporates = array();
    $query = "EXEC uspFetchCorporateUsers";
    $statement = sqlsrv_query( $connection, $query );
    
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    while ( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_ASSOC ) ) {
        array_push($corporates, $row);
    }

    return $corporates;
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

function getCorporate($UserID) {
    global $connection;
    $corporate = null;
    $query = "EXEC uspFetchCorporateUser @UserID = ?";
    $params = array( $UserID );
    $statement = sqlsrv_query( $connection, $query, $params );
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $corporate = sqlsrv_fetch_array( $statement );
    return $corporate;
}

function getSkills() {
    global $connection;
    $skills = array();
    $query = "EXEC uspFetchSkills";
    $statement = sqlsrv_query( $connection, $query);
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    while ( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_ASSOC ) ) {
        array_push($skills, $row);
    }

    return $skills;
}

function getTeams() {
    global $connection;
    $teams = array();
    $query = "EXEC uspFetchTeams";
    $statement = sqlsrv_query( $connection, $query);
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    while ( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_ASSOC ) ) {
        array_push($teams, $row);
    }
    
    return $teams;
}

function getTeamLead($teamID) {
    global $connection;
    $teamlead = null;
    $query = "EXEC uspFetchTeamLead @TeamID = ?";
    $params = array($teamID);
    $statement = sqlsrv_query( $connection, $query, $params );
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $teamlead = sqlsrv_fetch_array($statement);
    return $teamlead;
}

function getRegionByZip($ZIPCode) {
    global $connection;
    $region = '';

    $query = "EXEC uspGetRegionByZip @ZipCode = ?";
    $params = array($ZIPCode);
    $statement = sqlsrv_query($connection, $query, $params);
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $region = sqlsrv_fetch_array($statement);
    return $region;
}

function getRegionByTeam($TeamID) {
    global $connection;
    $region = '';

    $query = "EXEC uspGetRegionByTeam @TeamID = ?";
    $params = array($TeamID);
    $statement = sqlsrv_query($connection, $query, $params);
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $region = sqlsrv_fetch_array($statement);
    return $region;
}

function editCustomer($UserID, $firstName, $lastName, $email, $phone, $streetAddr, $city, $state, $zipCode) {
    global $connection;
    $query = 'EXEC uspEditCustomer @UserID = ?, @StreetAddr = ?, @city = ?, @state = ?, @ZIP = ?';
    $params = array($UserID, $streetAddr, $city, $state, $zipCode);
    $statement = sqlsrv_query($connection, $query, $params);
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $updatedRows = sqlsrv_rows_affected($statement);

    return editAccount($UserID, $firstName, $lastName, $email, $phone);
}

function editTechnician($UserID, $firstName, $lastName, $email, $phone) {
    
    return editAccount($UserID, $firstName, $lastName, $email, $phone);
}

function editCorpUser($userID, $firstName, $lastName, $email, $phone) {

    return editAccount($userID, $firstName, $lastName, $email, $phone);
}

function corpEditCustomer($userID, $firstName, $lastName, $email, $phone, $stAddr, $city, $state, $zipCode) {
    global $connection;
    $query = 'EXEC uspEditCustomer @UserID = ?, @StreetAddr = ?, @city = ?, @state = ?, @ZIP = ?';
    $params = array($userID, $stAddr, $city, $state, $zipCode);
    $statement = sqlsrv_query($connection, $query, $params);
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $updatedRows = sqlsrv_rows_affected($statement);

    return editAccount($userID, $firstName, $lastName, $email, $phone);
}

function corpEditTechnician($userID, $firstName, $lastName, $email, $phone, $skillLevel, $teamID) {
    global $connection;
    $query = 'EXEC uspEditTechnician @UserID = ?, @SkillLevel = ?, @TeamID = ?';
    $params = array($userID, $skillLevel, $teamID);
    $statement = sqlsrv_query($connection, $query, $params);
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $updatedRows = sqlsrv_rows_affected($statement);

    return editAccount($userID, $firstName, $lastName, $email, $phone);
}

function corpEditCorpUser($userID, $firstName, $lastName, $email, $phone) {
    return editAccount($userID, $firstName, $lastName, $email, $phone);
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

function disableAccount($UserID) {
// TODO
}

function enableAccount($UserID) {
// TODO
}
?>