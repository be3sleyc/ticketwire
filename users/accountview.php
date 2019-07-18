<?php include '../view/header.php'; ?>
<section>
    <div class="sectionContent">
    <h2>Account Details</h2>
    <?php if (($_SESSION['user_role'] == 'Corporate User - SysAdmin' OR $_SESSION['user_role'] == 'Corporate User - Manager') && ISSET($lookup_user)): ?>
            <form action="updateUser" method="POST" name="updateUser" id="updateUserFrom">
                <label>First Name: </label><input type="text" name="firstName" id="firstName" value="<?=$lookup_user['FirstName'];?>"><br>
                <label>Last Name: </label><input type="text" name="lastName" id="lastName" value="<?=$lookup_user['LastName'];?>"><br>
                <label>Email Address: </label><input type="email" name="emailAddress" id="emailAddress" value="<?=$lookup_user['EmailAddress'];?>"><br>
                <label>Phone Number: </label><input type="text" name="phoneNumber" id="phoneNumber" value="<?=$lookup_user['PhoneNumber'];?>"><br>
                <label>User Role: <?=$lookup_user['UserRole'];?></label><br>
                <a href=""><button>Reset Password</button></a>
                <button type="submit" id="save" disabled="">Save Changes</button>
            </form>
    <?php else: ?>
        <form action="updateUser" method="POST" name="updateUser" id="updateUserFrom">
            <label>First Name: </label><input type="text" name="firstName" id="firstName" value="<?=$_SESSION['first_name'];?>"><br>
            <label>Last Name: </label><input type="text" name="lastName" id="lastName" value="<?=$_SESSION['last_name'];?>"><br>
            <label>Email Address: </label><input type="email" name="emailAddress" id="emailAddress" value="<?=$_SESSION['email'];?>"><br>
            <label>Phone Number: </label><input type="text" name="phoneNumber" id="phoneNumber" value="<?=$_SESSION['phone'];?>"><br>
            <a href=""><button>Reset Password</button></a>
            <input type="submit" id="save" disabled="" value="Save Changes">
        </form> 
   <?php endif; ?>
    </div>
</section>
<script src="../scripts/jquery.js"></script>
<script>
$('form')
.each(function(){
    $(this).data('serialized', $(this).serialize())
})
.on('change input', function(){
    $(this) // changes submit buttons and inputs            
        .find('input:submit')
            .attr('disabled', $(this).serialize() == $(this).data('serialized'))
    ;
 })
.find('input:submit')
    .attr('disabled', true)
;
</script>
<?php include '../view/footer.php'; ?>