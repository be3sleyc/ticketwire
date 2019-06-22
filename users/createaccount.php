<?php include '../view/header.php'?>

<script>
function showPassword() {
    var x = document.getElementById("passwd");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>

<form action="/users/index.php" method="post" name="accountCreationForm">
<input type="hidden" name="action" value="create">
First Name:&nbsp;<input type="text" name="firstName"><br>
Last Name:&nbsp;<input type="text" name="lastName"><br>
Email:&nbsp;<input type="email" name="email"><br>
Password:&nbsp; <input type="password" name="password" id="passwd">
<input type="checkbox" onclick="showPassword()">Show password<br>
Change password on next login:&nbsp;<input type="checkbox" name="chngPasswd"><br>
User Role:&nbsp; <select name="userRole">
    <option value="cust">Customer</option>
    <option value="tech">Technician</option>
    <option value="corp">Corporate User</option>
</select> <br>
<input type="submit" value="Submit">
</form>
<?php include '../view/footer.php'?>