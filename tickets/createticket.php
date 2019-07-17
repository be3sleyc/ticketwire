<?php 
include '../view/header.php';
# Corporate Users only!
if ( strpos($_SESSION['user_role'], 'Corporate User') === false) {
    header('Location: /index.php');
}

?>
<section>
<h2>New Ticket</h2>
<form action="index.php" method="post">
<input type="hidden" name="action" value="create">
<div>
<label for="TCategory">Ticket Category</label><br>
<input type="text" name="TCategory" id="TCategory">
</div>
<div>
<label for="TDescription">Ticket Description</label><br>
<textarea name="TDescription" id="TDescription" cols="32" rows="8"></textarea>
</div>
<div>
<label for="Customer">Customer:</label><br>
<select name="Customer" id="Customer">
<?php foreach(getCustomers() as $cust):?>
    <option value="<?=$cust.UserID?>"><?=$cust.name?></option>
<?php endforeach;?>
</select>
<label for="customerEmail">Email:</label>
<input type="text" name="customerEmail" id="customerEmail" value="" readonly><br>
<label for="customerPhone">Phone:</label>
<input type="text" name="customerPhone" id="customerPhone" value="" readonly><br>
<label for="customerStreet">Street Address:</label>
<input type="text" name="customerStreet" id="customerStreet" value="" readonly><br>
<input type="text" name="customerZIP" id="customerZip" value="" readonly><br>
</div>
<div>
<label for="AssignTech">Assigned Technician</label>
<select name="AssignTech" id="AssignTech">
<?php foreach(getTechnicians() as $tech):?>
    <option value="<?=$tech.UserID?>"><?=$tech.Name . " - " . $tech.TeamID?></option>
<?php endforeach;?>
</select>
</div>
</form>
</section>
<?php include '../view/footer.php';?>