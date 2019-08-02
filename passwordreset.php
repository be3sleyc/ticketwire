<?php
 session_start();
 $source = filter_input(INPUT_GET, 'source');
 $userID = '';
 if( ISSET($_GET['userid']) ) {
   $userID = filter_input(INPUT_GET, 'userid');
} else if ( ISSET($_SESSION['user_id']) ) {
   $userID = $_SESSION['user_id'];
}
?>
   <?php if( $source == 'forgot' ): 
   include 'view/public_header.php';?>
   <section>
      <div class="sectionContent">  
         <h2>Account Recovery</h2>
         <p>Forget your password? We'll send you an email to help you reset your password. Please provide your email address associated with your ticketwire account and your date of birth.</p>
         <form action="" method="post">
            <label for="email">Email address:&nbsp;</label>
            <input type="email" name="recoveryEmail" id="recoveryEmail" require><br>
            <label for="DOB">Date of Birth:&nbsp;</label>
            <input type="date" name="recoverydob" id="recoverydob" require><br>
            <input type="submit" value="Submit">
         </form>
   </div>
</section>
<?php elseif( $source == 'edit' && ISSET($userID) ):
   include 'view/header.php';?>
   <section>
      <div class="sectionContent">
         <h2>Password Reset</h2>
         <?php if( $userID == $_SESSION['user_id'] ):?>
            <p>Please provide your old account password and a new password.</p>
            <form action="" method="post">
               <label for="oldpassword">Current password:&nbsp;</label>
               <input type="password" name="oldpassword" id="oldpassword" require><br>
               <label for="newpassword">New password:&nbsp;</label>
               <input type="password" name="newpassword" id="newpassword" require><br>
               <label for="new2password">Confirm new password:&nbsp;</label>
               <input type="password" name="new2password" id="new2password" require><br>
               <input type="submit" value="Submit">
            </form>
         <?php elseif( ($_SESSION['user_role'] == 'Corporate User - SysAdmin' OR $_SESSION['user_role'] == 'Corporate User - Manager') ):?>
            <p>Reset user <?=$userID?>'s users password</p>
               <form action="" method="post">
                  <label for="newpassword">New password:&nbsp;</label>
                  <input type="password" name="newpassword" id="newpassword" require><br>
                  <label for="new2password">Confirm new password:&nbsp;</label>
                  <input type="password" name="new2password" id="new2password" require><br>
                  <input type="submit" value="Submit">
               </form>
         <?php endif;?>
      </div>
   </section>
<?php elseif( $source == 'locked' && ISSET($_GET['user']) ): 
   include 'view/public_header.php';?>
   <section>
      <div class="sectionContent">
         <h2>Account Recovery</h2>
         <p>Your account is locked! You have unsuccessfully tried to log in to many times in too short of a time span.</p>
         <?php $email = filter_input(INPUT_GET, 'user', FILTER_SANITIZE_EMAIL);?>
         <p>User Account Email:&nbsp;<?=$email;?></p>
      </div>
   </section>
<?php endif;?>
<?=$userID;?>
<?php 
include 'view/footer.php'
?>