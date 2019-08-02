<?php include './model/tickets_database.php'; ?>
<section>
    <div class="sectionContent">
        <p>Hi, <?=$_SESSION['first_name']?> <?=$_SESSION['last_name']?></p>
        <?php $user = array( 'UserID'=>$_SESSION['user_id'], 'UserRole' => $_SESSION['user_role']);?>
        <p>
        You have <?php echo count(get_Tickets($user)); ?> open tickets. <br>
        <a href="../tickets/index.php?action=list">View Tickets</a><br>
        <?php if( $_SESSION['user_role'] == 'Technician - Team Lead' ):?>
        <a href="../tickets/index.php?action=list&team=1">View Team Tickets</a><br>
        <?php endif;?>
        </p>
    </div>
</section>