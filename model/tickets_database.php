<?php
require('database_connection.php');

function get_tickets_all(){
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

function get_team_tickets($TeamID) {
    #Returns tickets based on a team id
    global $connection;
    $tickets = array();
    $query = "EXEC uspFetchTeamTickets @TeamID = ?";
    $params = array($TeamID);
    $statement = sqlsrv_query($connection, $query, $params);
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    while ( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_ASSOC ) ) {
        array_push($tickets, $row);
    }
    
    return $tickets;
}

function get_tickets($user) {
    #Returns tickets based on user ID and Role
    global $connection;
    $tickets = array();
    $query = "EXEC uspFetchTickets @UserID = ?, @UserRole = ?";
    $params = array( $user['UserID'], $user['UserRole'] );
    $statement = sqlsrv_query( $connection, $query, $params );
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    while ( $row = sqlsrv_fetch_array( $statement, SQLSRV_FETCH_ASSOC ) ) {
        array_push($tickets, $row);
    }

    return $tickets;
}

function get_ticket($ticketID) {
    global $connection;
    $ticket = array();
    $query = "EXEC uspFetchTicket @ticketID = ?";
    $params = array($ticketID);
    $statement = sqlsrv_query($connection, $query, $params);

    if ( $statement === false) {
        die( print_r( sqlsrv_errors, true) );
    }

    $ticket = sqlsrv_fetch_array( $statement );

    return $ticket;
}

function get_comments($ticketID) {
    global $connection;
    $prcomments = array();
    $query = 'EXEC uspFetchPublicComments @TicketID = ?';
    $params = array($ticketID);
    $statement = sqlsrv_query($connection, $query, $params);

    if ( $statement === false ) { 
        die( print_r( sqlsrv_errors, true) );
    }

    while ($row = sqlsrv_fetch_array($statement, SQLSRV_FETCH_ASSOC)) {
        array_push($prcomments, $row);
    }

    return $prcomments;
}

function get_prcomments($ticketID) {
    global $connection;
    $prcomments = array();
    $query = 'EXEC uspFetchAllComments @TicketID = ?';
    $params = array($ticketID);
    $statement = sqlsrv_query($connection, $query, $params);

    if ( $statement === false ) { 
        die( print_r( sqlsrv_errors, true) );
    }

    while ($row = sqlsrv_fetch_array($statement, SQLSRV_FETCH_ASSOC)) {
        array_push($prcomments, $row);
    }

    return $prcomments;
}

function post_comment($ticketID, $userID, $commentbody, $internal) {
    global $connection;
    $query = "EXEC uspAddComment @TicketID = ? , @UserID = ?, @CommentBody = ?, @Internal = ?";
    $params = array($ticketID, $userID, $commentbody, $internal);
    $statement = sqlsrv_query($connection, $query, $params);
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $updatedRows = sqlsrv_rows_affected($statement);
    return $updatedRows;
}

function update_ticket_corp($ticketID, $ticketSubject, $ticketDescription, $ticketPriority, $ticketStatus, $ticketStatusReason, $ticketTechID) {
    global $connection;
    $query = "EXEC uspCorpEditTicket @TicketID = ?, @Subject = ?, @Description = ?, @Priority = ?, @TicketStatus = ?, @TicketStatusReason = ?, @TechID = ?";
    $params = array($ticketID, $ticketSubject, $ticketDescription, $ticketPriority, $ticketStatus, $ticketStatusReason, $ticketTechID);
    $statement = sqlsrv_query($connection, $query, $params);
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $updatedRows = sqlsrv_rows_affected($statement);
    return $updatedRows;
}

function update_ticket_tech($ticketID, $ticketStatus, $ticketStatusReason, $ticketLastContact, $ticketNextAppointment) {
    global $connection;
    $query = "EXEC uspTechEditTicket @TicketID = ?, @NextAppointment = ? , @LastContact = ?, @TicketStatus = ?, @TicketStatusReason = ?";
    $params = array($ticketID, $ticketLastContact, $ticketNextAppointment, $ticketStatus, $ticketStatusReason);
    $statement = sqlsrv_query($connection, $query, $params);
    if ( $statement === false ) {
        die( print_r( sqlsrv_errors(), true ) );
    }

    $updatedRows = sqlsrv_rows_affected($statement);
    return $updatedRows;
}

function create_ticket($corpID, $techID, $custID, $subject, $description, $priority) {
    global $connection;
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