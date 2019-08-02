<?php include './model/tickets_database.php'; ?>
<section>
    <!-- the customer home page should show the customers current open tickets-->
    <div class="sectionContent">
        <p>Hi, <?=$_SESSION['first_name']?> <?=$_SESSION['last_name']?> </p>
        <?php $user = array( 'UserID'=>$_SESSION['user_id'], 'UserRole' => $_SESSION['user_role']);?>
        <p>You have <?php echo count(get_Tickets($user)); ?> open tickets. <br>
        How can we help you today? <br> <br>
        <a href="../tickets/index.php?action=list">View Tickets</a>
        </p>
    </div>
</section>