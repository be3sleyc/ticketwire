<?php
require('database_connection.php');

function get_tickets(){
    #For Admins (Sys and Managers Not CSAs?) Only
    global $connection;
    $tickets = array();
    $query = "EXEC uspFetchAllTickets;"; #Does not exist, yet
    $statement = sqlsrv_query( $connection, $query );
    
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    while ( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_ASSOC ) ) {
        array_push($tickets, $row);
    }

    return $tickets;
}

function get_ticket($user) {
    #Returns ticket based on user ID and Role
    global $connection;
    $ticket = array();
    $query = "EXEC uspFetchTicket @UserID = ? @UserRole = ?";
    $params = array( $user['UserID'], $user['UserRole'] );
    $statement = sqlsrv_query( $connection, $query, $params );
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $ticket = sqlsrv_fetch_array( $statement );
    return $ticket;
}

function getCustomers() {
    $customers = array();
    return $customers;
}

function getTechnicians() {
    $technicians = array();
    return $technicians;
}
?>