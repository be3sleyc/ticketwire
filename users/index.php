<?php
// Start the session
session_start();
require('../model/model_users.php');

// Determine the function to run
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'login';
    }
}

// Determine user page
if ($action == 'login') {
    // TODO determine user role here, it should be part of user
    $email = filter_input(INPUT_POST, 'user', FILTER_VALIDATE_EMAIL, FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'pass');

    if ( $email == NULL or $password == NULL) {
        header( 'Location:/login.php?errors=Missing Credentials'); //TODO 
    }

    $user = get_user($email, $password);

    if ($user == null) {
        header("Location:/login.php?errors=Invalid Login Credentials"); //TODO 
    } else {
        $_SESSION['email'] = $user['EmailAddress'];
        $_SESSION['first_name'] = $user['FirstName'];
        $_SESSION['last_name'] = $user['LastName'];
        $_SESSION['user_role'] = $user['UserRole'];
        header('Location: /index.php'); //TODO
    }
} elseif ($action == 'list') {
    $users = get_users();
    include 'userlist.php';
} elseif ($action == 'viewAccount') {
    include 'accountview.php';
} elseif ($action == 'createAccount') {
    include 'createaccount.php';
} else {
    // R&D needed to fill out this use case
}
