<?php 
    session_start();
    if ( !isset($_SESSION['email']) ){
        include 'view/public_header.php';
    } else {
        include 'view/header.php';
    }
?>
<section>
<h2>Ticketwire Help</h2>
<p>Ticketwire was designed with ease in mind, but it can still be confusing to new users.</p>
</section>
<?php
include 'view/footer.php';
?>