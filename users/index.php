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

    //Check for email and password
    if ( $email == NULL ) {
        array_push($errors,'Missing+email');
    } 
    if ($password == NULL) {
        array_push($errors,'Missing+password'); 
    }
    if (count($errors) > 1) {
        $errorstr = join(",+", $errors);
        header("Location: /login.php?errors=$errorstr");
        exit();
    } else if (count($errors) > 0) {
        header("Location: /login.php?errors=$errors[0]");
        exit();
    }

    //TODO count bad attempts, prompt to recover password to unlock account
    $user = login($email, $password);

    if ($user == null) {
        $errors = "Invalid+Credentials";
        header("Location: /login.php?errors=$errors");
        exit();
    } elseif ($user == 'Locked') {
        $errors = "Account+is+locked";
        header("Location: /passwordreset.php?source=Locked&user=$email&errors=$errors");
        exit();
    } else {
        $_SESSION['UserID'] = $user[0];
        $_SESSION['first_name'] = $user[1];
        $_SESSION['last_name'] = $user[2];
        $_SESSION['email'] = $user[3];
        $_SESSION['phone'] = $user[4];
        $_SESSION['user_role'] = $user[5];
        if ($user[6] == NULL) {
            $_SESSION['profile_path'] = 'default.png';
        } else {
            $_SESSION['profile_path'] = $user[6];
        }
        header('Location: /index.php'); //TODO
        exit();
    }
} elseif ($action == 'list') {
    $users = get_users();
    include 'userlist.php';
} elseif ($action == 'viewAccount') {
    $message = '';
    if ($email = filter_input(INPUT_GET, 'email')) {
        $lookup_user = get_user($email);
        include 'accountview.php';
    } else {
        $role_name = $_SESSION['user_role'];
        include 'accountview.php';
    }
} elseif ($action == 'createAccount') {
    //depreciated
    $roles = get_UserRoles();
    include 'createaccount.php';
} elseif ($action == 'updateUser') {
    $userID = filter_input(INPUT_POST, 'userid');
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');
    $email = filter_input(INPUT_POST, 'emailAddress', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_NUMBER_INT);

    $message = editAccount($userID, $firstName, $lastName, $email, $phone);

    if ( strpos($message, 'success') > -1 ) {
        $user = get_user($email);
        //die(var_dump($user));
        $_SESSION['UserID'] = $user[0];
        $_SESSION['first_name'] = $user[1];
        $_SESSION['last_name'] = $user[2];
        $_SESSION['email'] = $user[3];
        $_SESSION['phone'] = $user[4];
        $_SESSION['user_role'] = $user[5];
        if ($user[6] == NULL) {
            $_SESSION['profile_path'] = 'default.png';
        } else {
            $_SESSION['profile_path'] = $user[6];
        }
    }

    include 'accountview.php';
    exit;
} elseif ($action == 'corpUpdateUser') {
    $userID = filter_input(INPUT_POST, 'userid');
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');
    $email = filter_input(INPUT_POST, 'emailAddress', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_NUMBER_INT);
    // This updates General information
    //TODO: will need to identify role of user being edited and update specific details
    $message = editAccount($userID, $firstName, $lastName, $email, $phone);
    
    $lookup_user = get_user($email);
    include 'accountview.php';
    exit;
}else {
    // R&D needed to fill out this use case
}
