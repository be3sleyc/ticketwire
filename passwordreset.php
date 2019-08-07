<?php
session_start();
$source = filter_input(INPUT_GET, 'source');
$userID = '';
if (isset($_GET['userid'])) {
   $userID = filter_input(INPUT_GET, 'userid');
} else if (isset($_SESSION['user_id'])) {
   $userID = $_SESSION['user_id'];
}
$message = '';
if (isset($_GET['message'])) {
   $message = filter_input(INPUT_GET, 'message');
}

?>
<?php switch ($source) {
   case 'forgot':
      include 'view/public_header.php'; ?>
   <section>
      <div class="sectionContent">
         <h2>Account Recovery</h2>
         <?php $message = "Email function is not setup. Please call us to reset your account."; ?>
         <div class="errors"><?= $message ?></div>
         <p>Forget your password? We'll send you an email to help you reset your password. Please provide your email address associated with your ticketwire account and your date of birth.</p>
         <form action="/users/index.php" method="post">
            <input type="hidden" name="action" value="forgotLockedOut">
            <input type="hidden" name="userID" value="<?= $userID ?>">
            <input type="hidden" name="source" value="forgot">
            <label for="email">Email address:&nbsp;</label>
            <input type="email" name="recoveryEmail" id="recoveryEmail" require><br>
            <label for="DOB">Date of Birth:&nbsp;</label>
            <input type="date" name="recoverydob" id="recoverydob" max="2099-01-01" require><br>
            <input type="submit" value="Submit">
         </form>
      </div>
   </section>
   <?php break;
case 'edit':
   if (isset($userID)) :
      include 'view/header.php'; ?>
      <section>
         <div class="sectionContent">
            <h2>Password Reset</h2>
            <div class="errors"><?= $message ?></div>
            <?php if ($userID == $_SESSION['user_id']) : ?>
               <p>Please provide your old account password and a new password.</p>
               <form action="/users/index.php" method="post">
                  <input type="hidden" name="action" value="userPasswordReset">
                  <input type="hidden" name="userID" value="<?= $userID ?>">
                  <input type="hidden" name="source" value="edit">
                  <label for="oldpassword">Current password:&nbsp;</label>
                  <input type="password" name="oldpassword" id="oldpassword" require><br>
                  <label for="newpassword">New password:&nbsp;</label>
                  <input type="password" name="newpassword" id="newpassword" require><br>
                  <label for="new2password">Confirm new password:&nbsp;</label>
                  <input type="password" name="new2password" id="new2password" require><br>
                  <input type="submit" value="Submit">
               </form>
            <?php endif; ?>
         </div>
      </section>
   <?php endif;
   break;
case 'corpEdit':
   if (($_SESSION['user_role'] == 'Corporate User - SysAdmin' or $_SESSION['user_role'] == 'Corporate User - Manager')) : 
      include 'view/header.php'; ?>
      <section>
         <div class="sectionContent">
            <h2>Password Reset</h2>
            <div class="errors"><?= $message ?></div>
            <p>Reset user <?= $userID ?>'s account password</p>
            <form action="/users/index.php" method="post">
               <input type="hidden" name="action" value="corpPasswordReset">
               <input type="hidden" name="userID" value="<?= $userID ?>">
               <input type="hidden" name="source" value="corpEdit">
               <input type="hidden" name="email" value="<?=filter_input(INPUT_GET,'email')?>">
               <label for="newpassword">New password:&nbsp;</label>
               <input type="password" name="newpassword" id="newpassword" require><br>
               <label for="new2password">Confirm new password:&nbsp;</label>
               <input type="password" name="new2password" id="new2password" require><br>
               <input type="submit" value="Submit">
            </form>
         </div>
      </section>
   <?php endif;
   break;
case 'Locked':
   if (isset($_GET['user'])) :
      include 'view/public_header.php'; ?>
      <section>
         <div class="sectionContent">
            <h2>Account Recovery</h2>
            <?php $message = "Email function is not setup. Please call us to reset your account."; ?>
            <div class="errors"><?= $message ?></div>
            <form action="/users/index.php" method="post">
               <input type="hidden" name="action" value="forgotLockedOut">
               <input type="hidden" name="userEmail" value="<?= filter_input(INPUT_GET, 'user') ?>">
               <input type="hidden" name="source" value="Locked">
               <p>Your account is locked! You must have unsuccessfully tried to log in too many times in too short of a timespan.<br>
                  Please provide your email and birthdate and we'll send you a link to reset your password, or you can wait for a corporate user to unlock your account. </p>
               <label for="email">Email address:&nbsp;</label>
               <input type="email" name="recoveryEmail" id="recoveryEmail" require><br>
               <label for="DOB">Date of Birth:&nbsp;</label>
               <input type="date" name="recoverydob" id="recoverydob" max="2099-01-01" require><br>
               <input type="submit" value="Submit">
            </form>
         </div>
      </section>
   <?php endif;
   break;
}
include 'view/footer.php' ?>