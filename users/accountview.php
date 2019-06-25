<?php include '../view/header.php'; ?>
<section>
    <div class="sectionContent">
    <h2>Account Details</h2>
    <?php if ($_SESSION['user_role'] == 'Corporate' && ISSET($lookup_user)): ?>
            <form action="updateUser" method="POST" name="updateUser" id="updateUserFrom">
                <label>First Name: </label><input type="text" name="firstName" id="firstName" value="<?=$lookup_user['FirstName'];?>"><br>
                <label>Last Name: </label><input type="text" name="lastName" id="lastName" value="<?=$lookup_user['LastName'];?>"><br>
                <label>Email Address: </label><input type="email" name="emailAddress" id="emailAddress" value="<?=$lookup_user['EmailAddress'];?>"><br>
                <label>Phone Number: </label><input type="text" name="phoneNumber" id="phoneNumber" value="<?=$lookup_user['PhoneNumber'];?>"><br>
                <label>User Role: <?=$lookup_user['UserRole'];?></label><br>
                <a href=""><button>Reset Password</button></a>
                <button type="submit" id="save" disabled="">Save Changes</button>
            </form>
    <?php else: 
        echo "First Name: " . $_SESSION['first_name'] . "<br>";
        echo "Last Name: " . $_SESSION['last_name'] . "<br>";
        echo "Email Address: " . $_SESSION['email'] . "<br>";
        echo "Phone Number: " . $_SESSION['phone'] . "<br>";
        echo "Role: " . $_SESSION['user_role'] . " since 2007";  
    endif; ?>
    </div>
</section>
<?php include '../view/footer.php'; ?>