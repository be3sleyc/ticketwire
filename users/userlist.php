<?php include '../view/header.php';

if ($_SESSION['user_role'] != 'Corporate') {
    header('Location: /index.php');
}

?>
<script>
    $('*[data-href]').on("click",function(){
        window.location = $(this).data('href');
        return false;
    });
    $("td > a").on("click",function(e){
        e.stopPropagation();
    });
</script>

<section>
<div>
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
        <tr data-href="../users/index.php?action=viewAccount&email=<?=$user['EmailAddress']?>">
            <td class="link"><a href="../users/index.php?action=viewAccount&email=<?=$user['EmailAddress']?>"><?=$user['EmailAddress']?></a></td>
            <td class="link"><a href="../users/index.php?action=viewAccount&email=<?=$user['EmailAddress']?>"><?=$user['FirstName']?></a></td>
            <td class="link"><a href="../users/index.php?action=viewAccount&email=<?=$user['EmailAddress']?>"><?=$user['LastName']?></a></td>
            <td class="link"><a href="../users/index.php?action=viewAccount&email=<?=$user['EmailAddress']?>"><?php 
                    preg_match( "/(\w{3})(\w{3})(\w{4})/", $user['PhoneNumber'], $matches );
                    echo '(' . $matches[1] . ') ' . $matches[2] . '-' . $matches[3];
                ?></a>
            </td>
            <td class="link"><a href="../users/index.php?action=viewAccount&email=<?=$user['EmailAddress']?>"><?=$user['UserRole']?></a></td>
        </tr>
    <?php endforeach;?>
</table>
<a href="/users/index.php?action=createAccount" class="left"><button type="button">+</button>Create Account</a>
</div>
</div>
</section>
<?php include '../view/footer.php'?>