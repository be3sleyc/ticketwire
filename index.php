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
?>
<div>
<?php switch($userRole){ 
case 'Corp':
    include "view/corphome.php";
    break;
case 'Tech':
    include 'view/techhome.php';
    break;
case 'Cust':
    include 'view/custhome.php';
    break;
} ?>
</div>

<?php include 'view/footer.php';?>