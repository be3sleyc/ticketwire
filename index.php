<?php 
    session_start();
    include 'view/header.php'; 
            
switch($_SESSION['user_role']){ 
case "Corporate User - SysAdmin":
    include "view/corphome.php";
    break;
case "Corporate User - Manager":
    include "view/corphome.php";
    break;
case "Corporate User - CSA":
    include "view/corphome.php";
    break;
case "Technician - Team Lead":
    $tickets = 0;
    include 'view/techhome.php';
    break;
case "Technician":
    $tickets = 0;
    include 'view/techhome.php';
    break;
case "Customer":
    include 'view/custhome.php';
    break;
}

include 'view/footer.php';