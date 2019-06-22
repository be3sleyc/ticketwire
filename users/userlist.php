<?php include '../view/header.php'?>
<table class="lists">
<tr>
    <th>Email</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Phone #</th>
    <th>Role</th>
</tr>
    <?php foreach ($users as $user): ?>
        <tr>
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
<?php include '../view/footer.php'?>