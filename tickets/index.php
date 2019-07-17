<?php
// Start the session
session_start();
require('../model/tickets_database.php');

// Determine the function to run
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list';
    }
}

if ($action == 'list') {
    # lists all tickets
    # should be different for each account: 
        # corp users see all
        # tech team leads see teams
        # tech and customer sees own.

} elseif ($action == 'view') {
# should include options to edit?
# able to view all comments

} elseif ($action == 'customerview') {
# should include options to add comment?
# public comments only

} elseif ($action == 'create') {
    #corp only
    include 'createticket.php';
}