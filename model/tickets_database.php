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

function create_ticket($corpID, $techID, $custID, $subject, $description, $priority) {
    // returns status, 0=OK, -1=Error
    global $connection;
    $ticketID = 0;
    if (ISSET($techID)) {
        $query = "EXEC uspCreateTicketwithTech @TechID = ?, @CustID = ?, @corpID = ?, @Priority = ?, @TickSubject = ?, @TickDescription = ?";
        $params = array( $techID, $custID, $corpID, $priority, $subject, $description );
    } else {
        $query = "EXEC uspCreateTicket @CustID = ?, @corpID = ?, @Priority = ?, @TickSubject = ?, @TickDescription = ?";
        $params = array( $custID, $corpID, $priority, $subject, $description );
    }
    
    $statement = sqlsrv_query( $connection, $query, $params );
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $query2 = "EXEC uspLastInsertedTicket";
    $statement2 = sqlsrv_query( $connection, $query2 );
    if ( $statement2 === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $ticket = sqlsrv_fetch_array( $statement2 );
    return $ticket[0];
}
?>