<?php 
    session_start();
    include 'view/header.php';    
?>
<div>
<?php switch($userRole){ 
case 'Corp':
    echo ("<p>Welcome <?=$firstName?> <?=$lastName?>, what would you like to do today?</p>");
    break;
case 'Tech':
    echo ("<p>You have 0 open tickets</p>");
    break;
case 'Cust':
    echo ("<p>How can we help you today?</p>");
    break;
} ?>
</div>

<?php include 'view/footer.php';?>