<?php
    if ( ISSET( $_SESSION['email'] ) ) {
        header( 'Location:/index.php' );
        exit();
    }
    session_start();
    $errors = filter_input(INPUT_GET, 'errors');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../design/core.css">
    <title>Ticketwire - Login</title>
</head>
<body class="login">
<div class="loginFormDiv">
    <form action="/users/index.php" method="post" class="loginForm">
        <label id="Welcome">Welcome to TicketWire!</label><br/><br/>
        <input type="hidden" name="action" value="login" />
        <input placeholder="Email" name="user" type="email" autofocus /><br /><br/>
        <input placeholder="Password" name="pass" type="password" /><br/><br/>
        <div class="errors"><?=$errors?>
        <?php if ( $errors != '' ): echo "<br/><br/>"; endif; ?>
        </div>
        <input name="submit" type="submit" value="submit" /><br /><br/>
        <a id="forgot" href="https://www.facebook.com/CRMBeesley" target="_blank">Forgot Password?</a>  
        <!--TODO: create password recovery page -->
    </form>
</div>
</body>
</html>