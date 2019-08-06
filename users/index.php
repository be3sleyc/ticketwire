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
    if ($email == NULL) {
        array_push($errors, 'Missing+email');
    }
    if ($password == NULL) {
        array_push($errors, 'Missing+password');
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
        $_SESSION['user_id'] = $user[0];
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
        if (substr($user[5], 0, 10) == 'Technician') {
            $technician = getTechnician($_SESSION['user_id']);
            $_SESSION['team_id'] = $technician[6];
        }
        header('Location: /index.php'); //TODO
        exit();
    }
} elseif ($action == 'list') {
    $users = getUsers();
    include 'userlist.php';
} elseif ($action == 'viewAccount') {
    $message = '';
    if ($email = filter_input(INPUT_GET, 'email')) {
        $lookup_user = getUser($email);
        include 'accountview.php';
    } else {
        $role_name = $_SESSION['user_role'];
        include 'accountview.php';
    }
} elseif ($action == 'createAccount') {
    //depreciated
    $roles = getUserRoles();
    include 'createaccount.php';
} elseif ($action == 'updateUser') {
    $userID = filter_input(INPUT_POST, 'userid');
    $firstName = filter_input(INPUT_POST, 'firstName');
    $lastName = filter_input(INPUT_POST, 'lastName');
    $email = filter_input(INPUT_POST, 'emailAddress', FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_NUMBER_INT);
    //$avatarPath = $_SESSION['profile_path'];
    $roleEdit = filter_input(INPUT_POST, 'roleAction');

    switch ($roleEdit) {
        case 'UpdateCust':
            $stAddr = filter_input(INPUT_POST, 'streetAddress');
            $citySt = filter_input(INPUT_POST, 'CityState');
            $city = explode(', ', $cityState)[0];
            $state = explode(', ', $cityState)[1];
            die(print_r($city . ' ' . $state, true));
            if (!isset($city) and !isset($state)) {
                $message = 'Invalid City, State';
                break;
            }
            $zipCode = filter_input(INPUT_POST, 'zip');
            $message = editCustomer($userID, $firstName, $lastName, $email, $phone, $stAddr, $city, $state, $zipCode);
            break;
        case 'UpdateTech':
            // techs cant edit any role-based personal info yet
            $message = editTechnician($userID, $firstName, $lastName, $email, $phone);
            break;
        case 'UpdateCorp':
            // corps cant edit any role-based personal info yet
            $message = editCorpUser($userID, $firstName, $lastName, $email, $phone);
            break;
    }

    if (strpos($message, 'success') > -1) {
        $user = getUser($email);
        $_SESSION['user_id'] = $user[0];
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
    $roleEdit = filter_input(INPUT_POST, 'roleAction');
    //$avatarPath = filter_input(INPUT_POST, 'profilePath');

    switch ($roleEdit) {
        case 'CorpUpdateCust':
            $stAddr = filter_input(INPUT_POST, 'streetAddress');
            $citySt = filter_input(INPUT_POST, 'CityState');
            $cityState = explode(', ', $citySt); 
            if (count($cityState) == 2 ) {
                $city = $cityState[0];
                $state = $cityState[1];
            } else {
                $message = 'Invalid City, State';
                break;
            }
            $zipCode = filter_input(INPUT_POST, 'zip');
            //contract lenght and vip?
            $message = corpEditCustomer($userID, $firstName, $lastName, $email, $phone, $stAddr, $city, $state, $zipCode);
            break;
        case 'CorpUpdateTech':
            $skillLevel = filter_input(INPUT_POST, 'SkillID');
            $teamID = filter_input(INPUT_POST, 'TeamID');
            //termdate?
            $message = corpEditTechnician($userID, $firstName, $lastName, $email, $phone, $skillLevel, $teamID);
            break;
        case 'CorpUpdateCorp':
            //termdate?
            $message = corpEditCorpUser($userID, $firstName, $lastName, $email, $phone);
            break;
    }

    $lookup_user = getUser($email);
    include 'accountview.php';
    exit;
} else {
    // R&D needed to fill out this use case
}
