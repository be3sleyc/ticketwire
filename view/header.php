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
    <link rel="icon" type="image/png" href="../images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
</head>

<body>
    <nav>
    <div class="menu_nav">
        <a class="home" href="/index.php">
          <img src="../images/ticket_100_90.png" alt="ticketwire logo">
          <span id='head-title'>Ticketwire</span>
        </a>
        <div class="right dropdown">
          <button onclick="showMenu()" class="dropdownBtn">
            <img class="avatar" src="<?="../images/avatar/" . $_SESSION['profile_path'];?>" alt="User Profile Picture">
            <?=$_SESSION['first_name'] . " " . $_SESSION['last_name'];?>
          </button>
          <div id="dropContent" class="dropdown-content">
            <a href="../users/index.php?action=viewAccount" title="View Account">View Account</a>
            <a href="../logout.php">Logout</a>
          </div>
        </div>
    </div>
    <div class="bar"></div>
  </nav>
    <script>
    function showMenu() {
      document.getElementById("dropContent").classList.toggle("show");
    }

    window.onclick = function(event) {
      if (!event.target.matches('.dropdownBtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }
    </script>