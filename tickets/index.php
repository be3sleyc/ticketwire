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
    if (isset($_GET['status'])) {
        $status = filter_input(INPUT_GET, 'status');
    }
    # lists all tickets
    # should be different for each account: 
    # corp users see all
    # tech team leads see teams
    # tech and customer sees own.

    $user = array('UserID' => $_SESSION['user_id'], 'UserRole' => $_SESSION['user_role']);

    if (substr($_SESSION['user_role'], 0, 9) == 'Corporate') {
        $tickets = get_tickets_all();
        include "ticketlistall.php";
    } elseif (isset($_GET['team']) || isset($_POST['team'])) {
        $tickets = get_team_tickets($_SESSION['team_id']);
        include "ticketlistteam.php";
    } else {
        $tickets = get_tickets($user);
        include "ticketlist.php";
    }
} elseif ($action == 'listone') {
    $status = '';
    if (isset($_GET['status'])) {
        $status = filter_input(INPUT_GET, 'status');
    }

    $user = array('UserID' => $_SESSION['user_id'], 'UserRole' => $_SESSION['user_role']);

    if (substr($_SESSION['user_role'], 0, 9) == 'Corporate') {
        $tickets = get_ticket($_SESSION['ticket']);
        include "ticketlistall.php";
    } elseif (isset($_GET['team']) || isset($_POST['team'])) {
        $tickets = get_team_tickets($_SESSION['team_id']);
        include "ticketlistteam.php";
    } else {
        $tickets = get_tickets($user);
        include "ticketlist.php";
    }
} elseif ($action == 'privateview') {
    $message = '';
    if (isset($_GET['ticketID'])) {
        $ticketID = filter_input(INPUT_GET, 'ticketID');
    }elseif (ISSET($_POST['ticketID'])) {
        $ticketID = filter_input(INPUT_POST, 'ticketID');
    } else {
        $status = 'No ticket specified';
        header("Location: ./index.php?action=list&status=$status");
        exit();
    }
    $ticket = get_ticket($ticketID);
    $technicians = getTechnicians();
    $comments = get_prcomments($ticketID);

    if (ISSET($_POST['message'])) {
        $message = filter_input(INPUT_POST, 'message');
    }

    if (substr($_SESSION['user_role'], 0, 9) == 'Corporate') {
        include "ticketviewprivateCorp.php";
    } elseif (substr($_SESSION['user_role'], 0, 10) == 'Technician' ) {
        include "ticketviewprivateTech.php";
    }
} elseif ($action == 'view') {
    # should include options to add comment?
    # public comments only
    $message = '';
    if (isset($_GET['ticketID'])) {
        $ticketID = filter_input(INPUT_GET, 'ticketID');
    }elseif (ISSET($_POST['ticketID'])) {
        $ticketID = filter_input(INPUT_POST, 'ticketID');
    } else {
        $status = 'No ticket specified';
        header("Location: ./index.php?action=list&status=$status");
        exit();
    }
    $ticket = get_ticket($ticketID);
    $technicians = getTechnicians();
    $comments = get_comments($ticketID);

    if (ISSET($_POST['message'])) {
        $message = filter_input(INPUT_POST, 'message');
    }

    include "ticketview.php";
} elseif ($action == 'postComment') {
    $ticketID = filter_input(INPUT_POST, 'ticketID');
    $userID = filter_input(INPUT_POST, 'newCommentAuthorID');
    $internal = filter_input(INPUT_POST, 'private');
    $commentBody = filter_input(INPUT_POST, 'newCommentBody');
    $postAction = filter_input(INPUT_POST, "PostAction");

    if (post_comment($ticketID, $userID, $commentBody, $internal)) {
        $message = 'Comment posted';
    } else {
        $message = 'Error posting comment';
    }

    header("Location: ./index.php?action=$postAction&ticketID=$ticketID&message=$message");
    exit;
} elseif ($action == 'techUpdate') {
    $ticketID = filter_input(INPUT_POST, 'ticketID');
    $ticketStatus = filter_input(INPUT_POST, 'ticketStatus');
    $ticketStatusReason = filter_input(INPUT_POST, 'ticketStatusReason');
    $ticketLastContact = filter_input(INPUT_POST, 'lastContact');
    $ticketNextAppointment = filter_input(INPUT_POST, 'nextAppointment');
    
    $message = update_ticket_tech($ticketID, $ticketStatus, $ticketStatusReason, $ticketLastContact, $ticketNextAppointment);

    header("Location: ./index.php?action=privateview&ticketID=$ticketID&message=$message");
    exit;
} elseif ($action == 'corpUpdate') {
    $ticketID = filter_input(INPUT_POST, 'ticketID');
    $ticketSubject = filter_input(INPUT_POST, 'subject');
    $ticketDescription = filter_input(INPUT_POST, 'description');
    $ticketPriority = filter_input(INPUT_POST, 'ticketPriority');
    $ticketStatus = filter_input(INPUT_POST, 'ticketStatus');
    $ticketStatusReason = filter_input(INPUT_POST, 'ticketStatusReason');
    $ticketTechID = filter_input(INPUT_POST, 'technicianID');

    $message = update_ticket_corp($ticketID, $ticketSubject, $ticketDescription, $ticketPriority, $ticketStatus, $ticketStatusReason, $ticketTechID);

    header("Location: ./index.php?action=privateview&ticketID=$ticketID&message=$message");
    exit;
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
