<?php include '../view/header.php'; ?>
<section>
    <div class="sectionContent">
        <?php if (($_SESSION['user_role'] == 'Corporate User - SysAdmin' or $_SESSION['user_role'] == 'Corporate User - Manager') && isset($lookup_user)) : ?>
            <h2 style="text-align:center;">Account Details:&nbsp;<?= $lookup_user['FirstName'] . ' ' . $lookup_user['LastName']; ?></h2>
            <div class="message"><?= $message ?></div>
            <form action=".\index.php" method="POST" name="updateUser" id="updateUserFrom">
                <div class="AccountInfo">
                    <div class="genInfo">
                        <h3>General Information</h3>
                        <input type="hidden" name="userid" value="<?= $lookup_user['UserID'] ?>">
                        <input type="hidden" name="action" value="corpUpdateUser">
                        <img src="<?= "/images/profile/full_" . $lookup_user['AvatarFilePath'] ?>" alt="Profile picture of <?= $lookup_user['FirstName'] . ' ' . $lookup_user['LastName']; ?>"><br>
                        <button title="This feature is not enabled." disabled>Change Picture</button><br>
                        <label>First Name:&nbsp;</label><input type="text" name="firstName" id="firstName" value="<?= $lookup_user['FirstName']; ?>" required><br>
                        <label>Last Name:&nbsp;</label><input type="text" name="lastName" id="lastName" value="<?= $lookup_user['LastName']; ?>" required><br>
                        <label>Email Address:&nbsp;</label><input type="email" name="emailAddress" id="emailAddress" value="<?= $lookup_user['EmailAddress']; ?>" required><br>
                        <label>Phone Number:&nbsp;</label><input type="text" name="phoneNumber" id="phoneNumber" value="<?= $lookup_user['PhoneNumber']; ?>" required><br>
                        <label>User Role:&nbsp;<?= $lookup_user['UserRole']; ?></label><br>
                    </div>

                    <!-- Split into role specific information-->
                    <div class="roleInfo">
                        <?php if ($lookup_user['UserRole'] == 'Customer') :
                            include 'customerview_corp.php';
                        elseif (strpos($lookup_user['UserRole'], 'Technician') > -1) :
                            include 'technicianview_corp.php';
                        elseif (strpos($lookup_user['UserRole'], 'Corporate') > -1) :
                            include 'corporateuserview_corp.php';
                        endif; ?>
                    </div>
                </div>
                <div style="text-align: center;">
                    <?php if ($lookup_user['Locked'] == 1) : ?>
                        <a id="unlock" href="/users/index.php?action=unlock&userID=<?= $lookup_user['UserID'] ?>&email=<?=$lookup_user['EmailAddress']?>"><button type="button">Unlock Account</button></a>
                    <?php endif; ?>
                    <a id="reset" href="../passwordreset.php?source=corpEdit&userid=<?= $lookup_user['UserID'] ?>&name=<?=$lookup_user['FirstName'] . ' ' . $lookup_user['LastName']?>"><button type="button">Reset Password</button></a>
                    <input type="submit" id="save" disabled="" value="Save Changes">
                    <a id="cancel" href="https://www.ticketwire.io/users/index.php?action=list">
                        <input type="button" value="Cancel">
                    </a>
                </div>
            </form>
        <?php else : ?>
            <h2 style="text-align:center;">Account Details:&nbsp;<?= $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></h2>
            <div class="message"><?= $message ?></div>
            <form action=".\index.php" method="POST" name="updateUser" id="updateUserFrom">
                <input type="hidden" name="action" value="updateUser">
                <input type="hidden" name="userid" value="<?= $_SESSION['user_id'] ?>">
                <div class="AccountInfo">
                    <div class="genInfo">
                        <img src="<?= "/images/profile/full_" . $_SESSION['profile_path'] ?>" alt="Profile picture of <?= $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?>"><br>
                        <button title="This feature is not enabled." disabled>Change Picture</button><br>
                        <label>First Name:&nbsp;</label><input type="text" name="firstName" id="firstName" value="<?= $_SESSION['first_name']; ?>" required><br>
                        <label>Last Name:&nbsp;</label><input type="text" name="lastName" id="lastName" value="<?= $_SESSION['last_name']; ?>" required><br>
                        <label>Email Address:&nbsp;</label><input type="email" name="emailAddress" id="emailAddress" value="<?= $_SESSION['email']; ?>" required><br>
                        <label>Phone Number:&nbsp;</label><input type="text" name="phoneNumber" id="phoneNumber" value="<?= $_SESSION['phone']; ?>" required><br>
                    </div>
                    <div class="roleInfo">
                        <?php if ($_SESSION['user_role'] == 'Customer') :
                            include 'customerview.php';
                        elseif (strpos($_SESSION['user_role'], 'Technician') > -1) :
                            include 'technicianview.php';
                        elseif (strpos($_SESSION['user_role'], 'Corporate') > -1) :
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
        .each(function() {
            $(this).data('serialized', $(this).serialize())
        })
        .on('change input', function() {
            $(this) // changes submit buttons and inputs            
                .find('input:submit')
                .attr('disabled', $(this).serialize() == $(this).data('serialized'));
        })
        .find('input:submit')
        .attr('disabled', true);
    // Update RegionName with Zip(input)
    // Update TeamLead and RegionID with TeamID(Select)
</script>
<script>
    function updateTeamLead(val) {
        $.post("getTeamLead.php", {
            TeamID: val
        }, function(data, status) {
            $("#TeamLead").html(data);
        });
    }

    function updateRegionName(val) {
        $.post("getRegion.php", {
            TeamID: val
        }, function(data, status) {
            $("#RegionName").html(data);
        });
        updateTeamLead(val);
    }

    function updateRegionInfo(val) {
        $.post("getRegion.php", {
            ZipCode: val
        }, function(data, status) {
            $("#RegionName").html(data);
        });
    }
</script>
<?php include '../view/footer.php'; ?>