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
<section>
  <h2>New Account</h2>
    <form class="createForm" action="/users/index.php" method="post" name="accountCreationForm">
    <input type="hidden" name="action" value="create">
    <div class="newAccount">
    <div class="gitem-left"><label>First Name:</label></div><div class="gitem-right"><input type="text" name="firstName" autofocus></div>
    <div class="gitem-left"><label>Last Name:</label></div><div class="gitem-right"><input type="text" name="lastName"></div>
    <div class="gitem-left"><label>Email:</label></div><div class="gitem-right"><input type="email" name="email"></div>
    <div class="gitem-left"><label>Password:</label></div><div class="gitem-right"><input type="password" name="password" id="passwd">
    <input type="checkbox" onclick="showPassword()">Show password</div>
    <div class="gitem-left"></div><div class="gitem-right"><input type="checkbox" name="chngPasswd"><label>Change password on next login:</label></div>
    <div class="gitem-left"><label>User Role:</label></div><div class="gitem-right"><select name="userRole">
        <?php foreach ($roles as $role): ?>
        <option value="<?=$role['RoleID']?>"><?=$role['RoleName']?></option>
        <?php endforeach; ?>
    </select></div>
    <div class="gitem-left"></div><div class="gitem-right"><input type="submit" value="Submit"></div>
    </div>
    </form>
</section>
<?php include '../view/footer.php'?>