<?php include '../view/header.php';

# Corporate Users only!
if ( strpos($_SESSION['user_role'], 'Corporate User') === false ) {
    header('Location: /index.php');
}

?>
<section>
<div>
    <h2>New Ticket</h2>
</div>
<form action="index.php" method="post">
<input type="hidden" name="action" value="create">
<div>
    <label for="TCategory">Ticket Category</label><br>
    <input type="text" name="TCategory" id="TCategory" size="32" required autofocus>
</div>
<div>
    <label for="TDescription">Ticket Description</label><br>
    <textarea name="TDescription" id="TDescription" cols="32" rows="8" required></textarea>
</div>
<div>
    <label for="AssignTech">Assigned Technician</label>
    <select name="AssignTech" id="AssignTech" required spellcheck>
        <option disabled selected>Select a Technician</option>
        <?php foreach($techs as $tech):?>
            <option value="<?=$tech['UserID']?>"><?=$tech['Name'] . " - " . $tech['RegionName']?></option>
        <?php endforeach;?>
    </select>
</div>
<div>
    <label for="Customer">Customer:</label>
    <select name="Customer" id="Customer" onchange="UpdateCustomerInfo(event)" required>
        <option disabled selected>Select a Customer</option>
        <?php foreach($customers as $cust):?>
            <option value=<?=$cust['UserID']?>><?=$cust['Name']?></option>
        <?php endforeach;?>
    </select><br>
    <div id="CustomerSummary"></div>
</div>
<div><input type="submit" value="Submit"></div>
</form>
<script src='../scripts/jquery.js'></script>
<script>
    function UpdateCustomerInfo(e) {
        var userID = document.getElementById("Customer")[document.getElementById("Customer").selectedIndex].value
        $.post( "customerInfo.php", { UserID : userID }, function(data, status) {
            $("#CustomerSummary").html(data);
        } );
    }
</script>
</section>
<?php include '../view/footer.php';?>