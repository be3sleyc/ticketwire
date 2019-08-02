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
<input type="hidden" name="action" value="createdata">
<input type="hidden" name="corp" value="<?=$_SESSION['user_id']?>">
<div class="grid-container">
    <div class="grid-left">
        <div class='item'>
            <label for="TSubject">Ticket Subject</label><br>
            <input type="text" name="TSubject" id="TSubject" size="32" required autofocus>
        </div>
        <div class='item'>
            <label for="TDescription">Ticket Description</label><br>
            <textarea name="TDescription" id="TDescription" cols="32" rows="8" required></textarea>
        </div>
        <div class='subcontainer'>
            <div class='sub-left'>
                <label for="AssignTech">Assign Technician: </label>
                <select name="AssignTech" id="AssignTech" onchange="UpdateTechnicianInfo(event)">
                    <option disabled selected>Select a Technician</option>
                    <?php foreach($techs as $tech):?>
                        <option value="<?=$tech['UserID']?>"><?=$tech['Name'] . " - " . $tech['RegionName']?></option>
                    <?php endforeach;?>
                </select>
                <div id="technicianSummary"></div>
            </div>
            <div class='subright'>
                <label for="priorityLevel">Priority Level:</label>
                <select name="priorityLevel" id="priorityLevel">
                    <option value="1">Question</option>
                    <option value="2" selected>General Issue</option>
                    <option value="3">Degraded Service</option>
                    <option value="4">Business Critical</option>
                </select>
            </div>
        </div>
    </div>
    <div class="grid-right">
        <label for="Customer">Customer:</label>
        <select name="Customer" id="Customer" onchange="UpdateCustomerInfo(event)" required>
            <option disabled selected>Select a Customer</option>
            <?php foreach($customers as $cust):?>
                <option value=<?=$cust['UserID']?>><?=$cust['Name']?></option>
            <?php endforeach;?>
        </select><br>
        <div id="customerSummary"></div>
    </div>
</div>
<div class="TicketCreateButtons">
    <input type="submit" value="Submit">
    <a id="cancel" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">
        <input type="button" value="Cancel">
    </a>
</div>
</form>
<script src='../scripts/jquery.js'></script>
<script>
    //function for updating customer info when a new customer is selected
    function UpdateCustomerInfo(e) {
        var userID = document.getElementById("Customer")[document.getElementById("Customer").selectedIndex].value
        $.post( "customerInfo.php", { UserID : userID }, function(data, status) {
            $("#customerSummary").html(data);
        } );
    }

    function UpdateTechnicianInfo(e) {
        var userID = document.getElementById("AssignTech")[document.getElementById("AssignTech").selectedIndex].value
        $.post( "technicianInfo.php", { UserID : userID }, function(data, status) {
            $("#technicianSummary").html(data);
        } );
    }
</script>
</section>
<?php include '../view/footer.php';?>