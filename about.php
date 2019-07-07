<?php 
    session_start();
    if ( !isset($_SESSION['email']) ){
        include 'view/public_header.php';
    } else {
        include 'view/header.php';
    }
?>
<section>
<div class="intro">
<h2>What is Ticketwire?</h2>
</div>
</section>
<?php
include 'view/footer.php';
?>