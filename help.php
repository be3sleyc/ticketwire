<?php 
    session_start();
    if ( !isset($_SESSION['email']) ){
        include 'view/public_header.php';
    } else {
        include 'view/header.php';
    }
?>
<section id="helpSection" onscroll="scrollFunction()">
<h2>Ticketwire Help</h2>
<p>Ticketwire was designed with ease in mind, but it can still be confusing to new users.</p>
<?php // FAQs should be available for everyone ?>
<div class="faq">
<h3>FAQs</h3>
<ul class="faqlinks">
<li><a href="#createTickets">Who can create tickets?</a> </li>
<li><a href="#closeTickets">Who can close tickets?</a></li>
<li><a href="#accountCreation">How do I get an account created?</a></li>
<li><a href="#openClosedTickets">Can I view open and closed tickets?</a></li>
<li><a href="#scheduleAppointment">How are tickets scheduled?</a></li>
<li><a href="#resetPassword">How do I reset my password?</a></li>
</ul>
<?php if ( isset($_SESSION['email']) ):?>
    <p><button class="moreInfo"><a href="<?php
        switch (substr($_SESSION['user_role'], 0, 4)) {
            case 'Corp':
                echo 'https://docs.google.com/document/d/1_vGbRqnQXk5cwyTgNQs9L8YEApsIBlCtaGj4ZF-m7v0/edit?usp=sharing';
                break;
            case 'Tech':
                echo 'https://docs.google.com/document/d/1vgDW_mmeADAhDmvONucMFhugihhS8NxKcbf8B-3qbzY/edit?usp=sharing';
                break;
            case 'Cust':
                echo 'https://docs.google.com/document/d/1eUonjgkB-rYyb58mAQ4Vw5NS69rVT61bNdknetYtcZE/edit?usp=sharing';
                break;
        }
    ?>" target="_blank">Need more infomation?</button>
    <?php if($_SESSION['user_role'] == "Corporate User - SysAdmin"):?>
    <button class="moreInfo"><a href="https://docs.google.com/document/d/1LnRx329KUdBe6_ywIRQ7Vm9Uv3wZPjnL2vmwTpD1xoY/edit?usp=sharing" target="_blank">Backend Information</a></button>
    <?php endif; ?>
    </p>
<?php endif;?>
<button onclick="topFunction()" id="topBtn" title="Go to top">Top</button> 
<p id="createTickets" class="question">Who can create tickets?</p>
<p class="answer">
Corporate users (call center agents) will create a ticket for a customer after they have contacted Northstar to inform us of an issue. 
</p>
<p id="closeTickets" class="question">Who can close tickets?</p>
<p class="answer">
Technicians and Corporate Users with appropriate notes/comments.
</p>
<p id="accountCreation" class="question">How do I get an account created?</p>
<p class="answer">
When a ticket is required, Corporate sends out an email to the users. Technicians are onboarded at the time of signing up to work with Corporate.
</p>
<p id="openClosedTickets" class="question">Can I view open and closed tickets?</p>
<p class="answer">
Yes, from your main ticket list view accessible from the home page or from your top right menu.
</p>
<p id="scheduleAppointment" class="question">How are tickets scheduled?</p>
<p class="answer">
A technician will contact the customer to schedule a time to service or assess a system.
</p>
<p id="resetPassword" class="question">How do I reset my password?</p>
<p class="answer">
Your password can be reset from your account details page once you have logged in. If you cannot login, you will need to call us to have a customer support assistant help you.
</p>
</div>
<div class="guides">
<?php //present list of guides based on user role if logged in, other wise just none ?>
</div>
</section>
<script src="/scripts/jquery.js"></script>
<script>
function scrollFunction() {
    var section = document.getElementById("helpSection");
    if (section.scrollTop > 400) {
        document.getElementById("topBtn").style.display = "block";
        $("#topBtn").fadeOut(7000);
    } else {
        document.getElementById("topBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    var section = document.getElementById("helpSection");
    section.scrollTop = 0;
} 
</script>
<?php
include 'view/footer.php';
?>