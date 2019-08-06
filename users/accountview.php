<?php include '../view/header.php'; ?>
<section>
    <div class="sectionContent">
    <div class="message"><?=$message?></div>
    <?php if (($_SESSION['user_role'] == 'Corporate User - SysAdmin' OR $_SESSION['user_role'] == 'Corporate User - Manager') && ISSET($lookup_user)): ?>
        <h2 style="text-align:center;">Account Details:&nbsp;<?=$lookup_user['FirstName'] . ' ' . $lookup_user['LastName'];?></h2>
            <form action=".\index.php" method="POST" name="updateUser" id="updateUserFrom">
                <div class="AccountInfo">
                    <div class="genInfo">
                    <h3>General Information</h3>
                    <input type="hidden" name="userid" value="<?=$lookup_user['UserID']?>">
                    <input type="hidden" name="action" value="corpUpdateUser">
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
                    <?php if( $lookup_user['UserRole'] == 'Customer' ):
                        include 'customerview_corp.php';
                    elseif( strpos($lookup_user['UserRole'], 'Technician') > -1 ):
                        include 'technicianview_corp.php';
                    elseif( strpos($lookup_user['UserRole'],'Corporate') > -1 ):
                        include 'corporateuserview_corp.php';                  
                    endif; ?>
                    </div>
                </div>
                <div style="text-align: center;">
                <a id="reset" href="../passwordreset.php?source=edit&userid=<?=$lookup_user['UserID']?>"><button type="button">Reset Password</button></a>
                <input type="submit" id="save" disabled="" value="Save Changes">
                <a id="cancel" href="https://www.ticketwire.io/users/index.php?action=list">
                    <input type="button" value="Cancel">
                </a>
                </div>
            </form>
    <?php else: ?>
        <h2 style="text-align:center;">Account Details:&nbsp;<?=$_SESSION['first_name'] . ' ' . $_SESSION['last_name'];?></h2>
        <form action=".\index.php" method="POST" name="updateUser" id="updateUserFrom">
            <input type="hidden" name="action" value="updateUser">
            <input type="hidden" name="userid" value="<?=$_SESSION['user_id']?>">
            <div class="AccountInfo">
                <div class="genInfo">
                    <img src="<?="/images/profile/full_".$_SESSION['profile_path']?>" alt="Profile picture of <?=$_SESSION['first_name'] . ' ' . $_SESSION['last_name'];?>"><br>
                    <input type="button" value="Change Picture"><br>
                    <label>First Name:&nbsp;</label><input type="text" name="firstName" id="firstName" value="<?=$_SESSION['first_name'];?>"><br>
                    <label>Last Name:&nbsp;</label><input type="text" name="lastName" id="lastName" value="<?=$_SESSION['last_name'];?>"><br>
                    <label>Email Address:&nbsp;</label><input type="email" name="emailAddress" id="emailAddress" value="<?=$_SESSION['email'];?>"><br>
                    <label>Phone Number:&nbsp;</label><input type="text" name="phoneNumber" id="phoneNumber" value="<?=$_SESSION['phone'];?>"><br>
                </div>
                <div class="roleInfo">
                    <?php if( $_SESSION['user_role'] == 'Customer' ):
                        include 'customerview.php';
                    elseif( strpos($_SESSION['user_role'], 'Technician') > -1 ):
                        include 'technicianview.php';
                    elseif( strpos($_SESSION['user_role'],'Corporate') > -1 ):
                        include 'corporateuserview.php';                  
                    endif; ?>
                </div>
            </div>
            <div style="text-align: center;">
            <a id="reset" href="../passwordreset.php?source=edit"><button type="button">Reset Password</button></a>&nbsp;
            <input type="submit" id="save" disabled="" value="Save Changes">
            <a id="cancel" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">
                <input type="button" value="Cancel">
            </a>
            </div>
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
// Update RegionName with Zip(input)
// Update TeamLead and RegionID with TeamID(Select)
</script>
<script>
function updateTeamLead(val) {
    $.post( "getTeamLead.php", { TeamID : val }, function(data, status) { $("#TeamLead").html(data); } );
}

function updateRegionName(val) {
    $.post( "getRegion.php", { TeamID : val }, function(data, status) { $("#RegionName").html(data); } );
    updateTeamLead(val);
}

function updateRegionInfo(val) {
    $.post( "getRegion.php", { ZipCode : val }, function(data, status) { $("#RegionName").html(data); } );
}
</script>
<?php include '../view/footer.php'; ?>