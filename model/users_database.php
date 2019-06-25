<?php
require('database_connection.php');

function login($email, $password) {
    global $connection;
    $user = '';
    $query = "EXEC uspLogIn @email = ?, @password = ?";
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
    $query = "EXEC uspFetchAllUsers;";
    $statement = sqlsrv_query( $connection, $query );
    
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    while ( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_ASSOC ) ) {
        $role = array_pop($row);
        $roleName = get_role($role);
        $row += ['UserRole' => $roleName];
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
    $query = "EXEC uspGetRoles";
    $statement = sqlsrv_query( $connection, $query );
    
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    while ( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_ASSOC ) ) {
        array_push($roles, $row);
    }

    return $roles;
}

function get_role($roleId) {
    global $connection;
    $role = '';
    $query = "EXEC uspGetRole @RoleId = ?";
    $params = array( $roleId );
    $statement = sqlsrv_query( $connection, $query, $params );
    
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $role = sqlsrv_fetch_array( $statement );
    return $role[0]; 
}

?>