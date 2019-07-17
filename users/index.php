<?php
// Start the session
session_start();
require('../model/users_database.php');

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
    $errors = array();
    if ( $email == NULL ) {
        array_push($errors,'Missing email');
    } 
    if ($password == NULL) {
        array_push($errors,'Missing password'); 
    }
    if (count($errors) > 1) {
        $errorstr = join(", ", $errors);
        header("Location: /login.php?errors=$errorstr");
        exit();
    } else if (count($errors) > 0) {
        header("Location: /login.php?errors=$errors[0]");
        exit();
    }

    //TODO count bad attempts, prompt to recover password to unlock account
    $user = login($email, $password);

    if ($user == null) {
        header("Location: /login.php?errors=Invalid Credentials");
        exit();
    } else {
        $_SESSION['first_name'] = $user[0];
        $_SESSION['last_name'] = $user[1];
        $_SESSION['email'] = $user[2];
        $_SESSION['phone'] = $user[3];
        $_SESSION['user_role'] = $user[4];
        if ($user[5] == NULL) {
            $_SESSION['profile_path'] = 'default.png';
        } else {
            $_SESSION['profile_path'] = $user[5];
        }
        var_dump($user);
        header('Location: /index.php'); //TODO
        exit();
    }
} elseif ($action == 'list') {
    $users = get_users();
    include 'userlist.php';
} elseif ($action == 'viewAccount') {
    if ($email = filter_input(INPUT_GET, 'email')) {
        $lookup_user = get_user($email);
        include 'accountview.php';
    } else {
        $role_name = $_SESSION['user_role'];
        include 'accountview.php';
    }
} elseif ($action == 'createAccount') {
    $roles = get_UserRoles();
    include 'createaccount.php';
} else {
    // R&D needed to fill out this use case
}
