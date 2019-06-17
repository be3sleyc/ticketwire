<?php
require('database_connection.php');

function get_user() {
    global $db;
    // TODO I need a where clause to get the only user I want. We can do email but have to ensure the email is unique
    $query = 'SELECT FirstName, LastName, EmailAddress, Password, UserRole FROM UserInfo';    
    $statement = $db->prepare($query);
    $statement->execute();
    $user = $statement->fetchAll();
    $statement->closeCursor();
    return $user;
}