<?php
  header('Content-Type: text/html; charset=iso-8859-1');

  // If no user is logged in, go to the login
  // TODO set the user variable somehow. This will take the form of allowing a user to stay logged in
  if ( !isset($_SESSION['user'])){
    header("location:login.php");
  }
  $first_name = $_SESSION['first_name'];
  $last_name = $_SESSION['last_name'];
?>

<!DOCTYPE html>
<html>

<head>
    <title>Ticketwire</title>
    <link rel="stylesheet" type="text/css" href="../core.css">
</head>

<body>
    Welcome <?=$first_name?> <?=$last_name?>
    <header>
        <h1>Ticketwire</h1>
    </header>
</body>

</html>