<?php 
    session_start();
    include 'view/header.php'; 
       
    if (ISSET($_SESSION['first_name']) and ISSET($_SESSION['last_name']) and ISSET($_SESSION['user_role']) ) {
        $firstName = $_SESSION['first_name'];
        $lastName = $_SESSION['last_name'];  
        $userRole = $_SESSION['user_role'];
      } else {
        $firstName = '';
        $lastName = '';
        $userRole = '';
      } 
      
switch($userRole){ 
case "Corporate":
    include "view/corphome.php";
    break;
case "Technician":
    include 'view/techhome.php';
    break;
case "Customer":
    include 'view/custhome.php';
    break;
}

include 'view/footer.php';