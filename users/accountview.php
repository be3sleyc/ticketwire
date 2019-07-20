<?php include '../view/header.php'; ?>
<section>
    <div class="sectionContent">
    <div class="message"><?=$message?></div>
    <h2>Account Details</h2>
    <?php if (($_SESSION['user_role'] == 'Corporate User - SysAdmin' OR $_SESSION['user_role'] == 'Corporate User - Manager') && ISSET($lookup_user)): ?>
            <form action=".\index.php" method="POST" name="updateUser" id="updateUserFrom">
                <input type="hidden" name="action" value="corpUpdateUser">
                <div class="genInfo">
                <h3>General Information</h3>
                <input type="hidden" name="userid" value="<?=$lookup_user['UserID']?>">
                <img src="<?="/images/profile/full_".$lookup_user['AvatarFilePath']?>" alt="Profile picture of <?=$lookup_user['FirstName'] . ' ' . $lookup_user['LastName'];?>"><br>
                <input type="button" value="Change Picture"><br>
                <label>First Name:&nbsp;</label><input type="text" name="firstName" id="firstName" value="<?=$lookup_user['FirstName'];?>"><br>
                <label>Last Name:&nbsp;</label><input type="text" name="lastName" id="lastName" value="<?=$lookup_user['LastName'];?>"><br>
                <label>Email Address:&nbsp;</label><input type="email" name="emailAddress" id="emailAddress" value="<?=$lookup_user['EmailAddress'];?>"><br>
                <label>Phone Number:&nbsp;</label><input type="text" name="phoneNumber" id="phoneNumber" value="<?=$lookup_user['PhoneNumber'];?>"><br>
                <label>User Role:&nbsp;<?=$lookup_user['UserRole'];?></label><br>
                </div>
                <!-- Split into role specific information-->
                <div class="roleInfo">
                <?php if($lookup_user['UserRole'] == 'Customer'):?>
                    <h3>Customer Information</h3>
                    <?php $customerInfo = getCustomer($lookup_user['UserID']);?>
                    <label for="customerSince">Customer Since:&nbsp;<?=$customerInfo['StartDate'];?></label><br>
                    <label for="birthDate">Birthdate:&nbsp;<?=$customerInfo['BirthDate'];?></label><br>
                    <label for="streetAddress">Street Address:</label><br>
                    <div class="address">
                        <input type="text" name="streetAddress" id="streetAddress" value="<?=$customerInfo['StreetAddr'];?>"><br>
                        <input type="text" name="CityState" id="CityState" value="<?=$customerInfo['City'].", ".$customerInfo['State'];?>"><br>
                        <input type="text" name="zip" id="zip" size="7" value="<?=$customerInfo['ZIPCode'];?>">
                    </div>
                    <label for="regionInfo">Region:&nbsp;<?=$customerInfo['RegionName'];?></label>
                <?php elseif($lookup_user['UserRole'] == 'Technician'):?>
                <?php endif; ?>
                </div>
                <a href="../passwdreset.php?source=edit&userid=<?=$lookup_user['UserID']?>"><button>Reset Password</button></a>
                <input type="submit" id="save" disabled="" value="Save Changes">
            </form>
    <?php else: ?>
        <form action=".\index.php" method="POST" name="updateUser" id="updateUserFrom">
            <input type="hidden" name="action" value="updateUser">
            <input type="hidden" name="userid" value="<?=$_SESSION['UserID']?>">
            <label>First Name:&nbsp;</label><input type="text" name="firstName" id="firstName" value="<?=$_SESSION['first_name'];?>"><br>
            <label>Last Name:&nbsp;</label><input type="text" name="lastName" id="lastName" value="<?=$_SESSION['last_name'];?>"><br>
            <label>Email Address:&nbsp;</label><input type="email" name="emailAddress" id="emailAddress" value="<?=$_SESSION['email'];?>"><br>
            <label>Phone Number:&nbsp;</label><input type="text" name="phoneNumber" id="phoneNumber" value="<?=$_SESSION['phone'];?>"><br>
            <a href="../passwdreset.php?source=edit"><button>Reset Password</button></a>
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