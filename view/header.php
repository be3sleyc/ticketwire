<?php
  header('Content-Type: text/html; charset=iso-8859-1');

  // If no user is logged in, go to the login
  // TODO set the user variable somehow. This will take the form of allowing a user to stay logged in
  if ( !isset($_SESSION['email'])){
    header("location:/login.php");
  }  
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ticketwire</title>
    <link rel="stylesheet" type="text/css" href="../design/core.css">
</head>

<body>
    <header>
    <div class="menu_banner_div">
      <ul class="menu_banner">
        <li><a href="/index.php"><img src="../images/ticket_100_90.png" alt="ticketwire logo"></a></li>
        <li class="right"><a href="../logout.php">Logout</a></li>
      </ul>
    </div>  
    </header>
    <h1>Ticketwire</h1>