<?php
// Start the session
session_start();
require('../model/tickets_database.php');
require('../model/users_database.php');

// Determine the function to run
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list';
    }
}

if ($action == 'list') {
    $status = '';
    if( ISSET($_GET['status']) ) {
        $status = filter_input(INPUT_GET, 'status');
    }
    # lists all tickets
    # should be different for each account: 
        # corp users see all
        # tech team leads see teams
        # tech and customer sees own.

    $user = array('UserID'=> $_SESSION['user_id'],'UserRole'=>$_SESSION['user_role']);

    if (substr($_SESSION['user_role'],0,9) == 'Corporate' ) {
        $tickets = get_tickets_all();
        include "ticketlistall.php";
    } elseif (ISSET($_GET['team']) || ISSET($_POST['team']) ) {
        $tickets = get_team_tickets($_SESSION['team_id']);
        include "ticketlistteam.php";
    } else {
        $tickets = get_tickets($user);
        include "ticketlist.php";
    }

} elseif ($action == 'privateview') {
    if( ISSET($_GET['ticketID']) ) {
        $ticketID = filter_input(INPUT_GET, 'ticketID');
        $ticket = get_ticket($ticketID);
        $comments = get_prcomment($ticketID);
        include "ticketviewprivate.php";
    }
# should include options to edit?
# able to view all comments

} elseif ($action == 'view') {
# should include options to add comment?
# public comments only

} elseif ($action == 'create') {
    #corp only
    $customers = getCustomers(); // Ought to simplify this to just UserID and Name, Have a separate function to get customer details by ID
    $techs = getTechnicians();

    include 'createticket.php';
} elseif ($action == 'createdata') {
    $corpID = filter_input(INPUT_POST, 'corp', FILTER_VALIDATE_INT);
    $techID = filter_input(INPUT_POST, 'AssignTech');
    $custID = filter_input(INPUT_POST, 'Customer', FILTER_VALIDATE_INT);
    $subject = filter_input(INPUT_POST, 'TSubject');
    $description = filter_input(INPUT_POST, 'TDescription');
    $priority = filter_input(INPUT_POST, 'priorityLevel', FILTER_VALIDATE_INT);

    // redirect to privateview of ticket if successful, ticket list if not
    $ticketID = create_ticket($corpID, $techID, $custID, $subject, $description, $priority);
    if ($ticketID > 0) {
        $status = 'Ticket create Successful';
        header("Location: ./index.php?action=privateview&ticketID=$ticketID&status=$status"); 
    exit();
    } else {
        $status = "Failure creating ticket$ticketID";
        header("Location: ./index.php?action=list&status=$status"); 
        exit();
    }
    
    
}