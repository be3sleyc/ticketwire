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
<li><a href="#ticketStatus">How do I check the status of my ticket?</a> </li>
<li><a href="#getAccount">How do I get an account?</a></li>
<li><a href="#missedAppointment">What do I do if my technician misses an appointment?</a></li>
<li><a href="#billingQuestions">How do I get questions answered about my bill?</a></li>
<li><a href="#cancelAppointment">What do I do if I need to cancel an appointment?</a></li>
<li><a href="#resetPassword">How do I reset my password?</a></li>
<li><a href="#payBill">Can I use the app to pay my bill?</a></li>
<li><a href="#armSystem">Can I use the app to arm my system?</a></li>
<li><a href="#seeTickets">Where do I go to see my tickets?</a></li>
<li><a href="#scheduleAppointment">How do I get someone to come out and service my account?</a></li>
</ul>
<?php if ( isset($_SESSION['email']) ):?>
    <p>Need more infomation?</p>
<?php endif;?>
<button onclick="topFunction()" id="topBtn" title="Go to top">Top</button> 
<p id="ticketStatus" class="question">How do I check the status of my ticket?</p>
<p class="answer">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin molestie enim, quis vestibulum est semper quis. Morbi eu porttitor nibh, ac imperdiet ligula. Sed rutrum iaculis quam vitae venenatis. Vestibulum placerat lorem arcu, quis aliquet enim mollis ut. Etiam placerat risus vel metus feugiat, at posuere dolor lobortis. Pellentesque eget lectus eget ex iaculis convallis. Nunc volutpat efficitur leo, at convallis libero commodo gravida. Nulla quis justo lectus. Cras dictum lobortis molestie. Proin commodo velit id metus bibendum, id commodo risus semper. Vivamus lectus massa, tempus id vulputate vel, rhoncus non magna. Cras porttitor diam id arcu ullamcorper viverra. Sed venenatis vel elit vel ornare. Nunc sit amet gravida dolor. Nulla nec sodales eros. 
</p>
<p id="getAccount" class="question">How do I get an account?</p>
<p class="answer">
If you already have a service contract with Northstar Alarm or Northstar Home , contact a Northstar Customer Support Agent.
</p>
<p id="missedAppointment" class="question">What do I do if my technician misses an appointment?</p>
<p class="answer">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin molestie enim, quis vestibulum est semper quis. Morbi eu porttitor nibh, ac imperdiet ligula. Sed rutrum iaculis quam vitae venenatis. Vestibulum placerat lorem arcu, quis aliquet enim mollis ut. Etiam placerat risus vel metus feugiat, at posuere dolor lobortis. Pellentesque eget lectus eget ex iaculis convallis. Nunc volutpat efficitur leo, at convallis libero commodo gravida. Nulla quis justo lectus. Cras dictum lobortis molestie. Proin commodo velit id metus bibendum, id commodo risus semper. Vivamus lectus massa, tempus id vulputate vel, rhoncus non magna. Cras porttitor diam id arcu ullamcorper viverra. Sed venenatis vel elit vel ornare. Nunc sit amet gravida dolor. Nulla nec sodales eros. 
</p>
<p id="billingQuestions" class="question">How do I get questions answered about my bill?</p>
<p class="answer">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin molestie enim, quis vestibulum est semper quis. Morbi eu porttitor nibh, ac imperdiet ligula. Sed rutrum iaculis quam vitae venenatis. Vestibulum placerat lorem arcu, quis aliquet enim mollis ut. Etiam placerat risus vel metus feugiat, at posuere dolor lobortis. Pellentesque eget lectus eget ex iaculis convallis. Nunc volutpat efficitur leo, at convallis libero commodo gravida. Nulla quis justo lectus. Cras dictum lobortis molestie. Proin commodo velit id metus bibendum, id commodo risus semper. Vivamus lectus massa, tempus id vulputate vel, rhoncus non magna. Cras porttitor diam id arcu ullamcorper viverra. Sed venenatis vel elit vel ornare. Nunc sit amet gravida dolor. Nulla nec sodales eros. 
</p>
<p id="cancelAppointment" class="question">What do I do if I need to cancel an appointment?</p>
<p class="answer">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin molestie enim, quis vestibulum est semper quis. Morbi eu porttitor nibh, ac imperdiet ligula. Sed rutrum iaculis quam vitae venenatis. Vestibulum placerat lorem arcu, quis aliquet enim mollis ut. Etiam placerat risus vel metus feugiat, at posuere dolor lobortis. Pellentesque eget lectus eget ex iaculis convallis. Nunc volutpat efficitur leo, at convallis libero commodo gravida. Nulla quis justo lectus. Cras dictum lobortis molestie. Proin commodo velit id metus bibendum, id commodo risus semper. Vivamus lectus massa, tempus id vulputate vel, rhoncus non magna. Cras porttitor diam id arcu ullamcorper viverra. Sed venenatis vel elit vel ornare. Nunc sit amet gravida dolor. Nulla nec sodales eros. 
</p>
<p id="resetPassword" class="question">How do I reset my password?</p>
<p class="answer">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin molestie enim, quis vestibulum est semper quis. Morbi eu porttitor nibh, ac imperdiet ligula. Sed rutrum iaculis quam vitae venenatis. Vestibulum placerat lorem arcu, quis aliquet enim mollis ut. Etiam placerat risus vel metus feugiat, at posuere dolor lobortis. Pellentesque eget lectus eget ex iaculis convallis. Nunc volutpat efficitur leo, at convallis libero commodo gravida. Nulla quis justo lectus. Cras dictum lobortis molestie. Proin commodo velit id metus bibendum, id commodo risus semper. Vivamus lectus massa, tempus id vulputate vel, rhoncus non magna. Cras porttitor diam id arcu ullamcorper viverra. Sed venenatis vel elit vel ornare. Nunc sit amet gravida dolor. Nulla nec sodales eros. 
</p>
<p id="payBill" class="question">Can I use the app to pay my bill?</p>
<p class="answer">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin molestie enim, quis vestibulum est semper quis. Morbi eu porttitor nibh, ac imperdiet ligula. Sed rutrum iaculis quam vitae venenatis. Vestibulum placerat lorem arcu, quis aliquet enim mollis ut. Etiam placerat risus vel metus feugiat, at posuere dolor lobortis. Pellentesque eget lectus eget ex iaculis convallis. Nunc volutpat efficitur leo, at convallis libero commodo gravida. Nulla quis justo lectus. Cras dictum lobortis molestie. Proin commodo velit id metus bibendum, id commodo risus semper. Vivamus lectus massa, tempus id vulputate vel, rhoncus non magna. Cras porttitor diam id arcu ullamcorper viverra. Sed venenatis vel elit vel ornare. Nunc sit amet gravida dolor. Nulla nec sodales eros. 
</p>
<p id="armSystem" class="question">Can I use the app to arm my system?</p>
<p class="answer">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin molestie enim, quis vestibulum est semper quis. Morbi eu porttitor nibh, ac imperdiet ligula. Sed rutrum iaculis quam vitae venenatis. Vestibulum placerat lorem arcu, quis aliquet enim mollis ut. Etiam placerat risus vel metus feugiat, at posuere dolor lobortis. Pellentesque eget lectus eget ex iaculis convallis. Nunc volutpat efficitur leo, at convallis libero commodo gravida. Nulla quis justo lectus. Cras dictum lobortis molestie. Proin commodo velit id metus bibendum, id commodo risus semper. Vivamus lectus massa, tempus id vulputate vel, rhoncus non magna. Cras porttitor diam id arcu ullamcorper viverra. Sed venenatis vel elit vel ornare. Nunc sit amet gravida dolor. Nulla nec sodales eros. 
</p>
<p id="seeTickets" class="question">Where do I go to see my tickets?</p>
<p class="answer">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin molestie enim, quis vestibulum est semper quis. Morbi eu porttitor nibh, ac imperdiet ligula. Sed rutrum iaculis quam vitae venenatis. Vestibulum placerat lorem arcu, quis aliquet enim mollis ut. Etiam placerat risus vel metus feugiat, at posuere dolor lobortis. Pellentesque eget lectus eget ex iaculis convallis. Nunc volutpat efficitur leo, at convallis libero commodo gravida. Nulla quis justo lectus. Cras dictum lobortis molestie. Proin commodo velit id metus bibendum, id commodo risus semper. Vivamus lectus massa, tempus id vulputate vel, rhoncus non magna. Cras porttitor diam id arcu ullamcorper viverra. Sed venenatis vel elit vel ornare. Nunc sit amet gravida dolor. Nulla nec sodales eros. 
</p>
<p id="scheduleAppointment" class="question">How do I get someone to come out and service my account?</p>
<p class="answer">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin molestie enim, quis vestibulum est semper quis. Morbi eu porttitor nibh, ac imperdiet ligula. Sed rutrum iaculis quam vitae venenatis. Vestibulum placerat lorem arcu, quis aliquet enim mollis ut. Etiam placerat risus vel metus feugiat, at posuere dolor lobortis. Pellentesque eget lectus eget ex iaculis convallis. Nunc volutpat efficitur leo, at convallis libero commodo gravida. Nulla quis justo lectus. Cras dictum lobortis molestie. Proin commodo velit id metus bibendum, id commodo risus semper. Vivamus lectus massa, tempus id vulputate vel, rhoncus non magna. Cras porttitor diam id arcu ullamcorper viverra. Sed venenatis vel elit vel ornare. Nunc sit amet gravida dolor. Nulla nec sodales eros. 
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