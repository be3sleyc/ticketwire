<?php include '../view/header.php';

if ($_SESSION['user_role'] != 'Corp') {
    header('Location: /index.php');
}

?>
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
        <tr>
            <a href=""></a>
            <td><?=$user['EmailAddress']?></td>
            <td><?=$user['FirstName']?></td>
            <td><?=$user['LastName']?></td>
            <td><?php 
                    preg_match( "/(\w{3})(\w{3})(\w{4})/", $user['PhoneNumber'], $matches );
                    echo '(' . $matches[1] . ') ' . $matches[2] . '-' . $matches[3];
                ?>
            </td>
            <td><?=$user['UserRole']?></td>
        </tr>
    <?php endforeach;?>
</table>
<a href="/users/index.php?action=createAccount"><button type="button">+</button>Create Account</a>
</div>
<?php include '../view/footer.php'?>