<?php
  // If no user is logged in, go to the login
  if ( !isset($_SESSION['email']) ){
    header( "Location:/login.php" );
    exit();
  }  
  header('Content-Type: text/html; charset=iso-8859-1');
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
        <li>
          <a href="/index.php"><img src="../images/ticket_100_90.png" alt="ticketwire logo">
          <span id='head-title'>Ticketwire</span></a>
        </li>
        <div class="right">
          <li class="right">
            <a href="../users/index.php?action=viewAccount" title="View Account"><?=$_SESSION['first_name'] . " " . $_SESSION['last_name'];?></a>&nbsp;&nbsp;
          </li>
          <li class="right">
            <a href="../logout.php">
              <button>Logout</button>
            </a>
          </li>
        </div>
      </ul>
    </div>
    <div class="bar"></div>
    </header>