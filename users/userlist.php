<?php include '../view/header.php';

if ($_SESSION['user_role'] != 'Corporate User - Manager' AND $_SESSION['user_role'] != 'Corporate User - SysAdmin') {
    header('Location: /index.php');
}

?>

<section>
<div class='sectionContent'>
    <h2>All Users</h2>
    <div class="list">
        <table>
            <tr>
                <th>Email</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone #</th>
                <th>Role</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr class="userlink" onclick="document.location='/users/index.php?action=viewAccount&email=<?=$user['EmailAddress']?>';">
                    <td><?=$user['EmailAddress']?></td>
                    <td><?=$user['FirstName']?></td>
                    <td><?=$user['LastName']?></td>
                    <td><?php 
                            echo preg_replace( "/(\w{3})(\w{3})(\w{4})/", "($1) $2-$3",$user['PhoneNumber']);
                        ?>
                    </td>
                    <td><?=$user['UserRole']?></td>
                </tr>
            <?php endforeach;?>
        </table>
        <!-- depreciated <a href="/users/index.php?action=createAccount" class="left"><button type="button">+</button>Create Account</a> -->
    </div>
</div>
</section>
<?php include '../view/footer.php'?>