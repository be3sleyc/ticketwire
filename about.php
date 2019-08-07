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
<br>
<p>
    Ticketwire is a web based ticket managment system, conceptually developed for Northstar Alarm. <br>
    Ticketwire was designed for customers to be able to view and answer or ask questions about current tickets; and as a way for managers and technicians to create, edit, and fulfil ticket requests. <br>
</p>
<h2></h2>
    Ticketwire was developed by six Utah Valley University IT or IS students over the 2019 Spring and Summer semesters.<br>
    <ul>
        <li>
            <h3>Mazen Alshareef</h3>
            <p></p>
        </li>
        <li>
            <h3>Christian Beesley</h3>
            <p></p>
        </li>
        <li>
            <h3>Mariah Brown</h3>
            <p></p>
        </li>
        <li>
            <h3>Derek Kennet</h3>
            <p></p>
        </li>
        <li>
            <h3>Cody Pickett</h3>
            <p></p>
        </li>
        <li>
            <h3>Jay Waldron</h3>
            <p></p>
        </li>
    </ul>
</div>
</section>
<?php
include 'view/footer.php';
?>