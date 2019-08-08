<h3>Customer Information</h3>
<input type="hidden" name="roleAction" value="UpdateCust">
<?php $customerInfo = getCustomer($_SESSION['user_id']);?>
<label for="customerSince">Customer Since:&nbsp;<?=$customerInfo['StartDate'];?></label><br>
<label for="birthDate">Birthdate:&nbsp;<?=$customerInfo['BirthDate'];?></label><br>
<label for="streetAddress">Street Address:</label><br>
<div class="address">
    <input type="text" name="streetAddress" id="streetAddress" value="<?=$customerInfo['StreetAddr'];?>" required><br>
    <input type="text" name="CityState" id="CityState" value="<?=$customerInfo['City'].", ".$customerInfo['State'];?>" required><br>
    <input type="text" name="zip" id="zip" size="7" onchange="updateRegionInfo(this.value)" value="<?=$customerInfo['ZIPCode'];?>" required>
</div>
<label for="regionInfo">Region:&nbsp;<span id="RegionName"><?=$customerInfo['RegionName'];?></span></label><br><br>
<h3>Contract Information</h3>
<label for="ContractID">Contract ID:&nbsp;<?=$customerInfo['ContractID'];?></label><br>
<label for="ContractVIP">VIP:&nbsp;<?php  echo ($customerInfo['VIP'] == 1) ? 'Yes' : 'No';?></label><br>
<label for="ContractStartDate">Start Date:&nbsp;<?=$customerInfo['ContractStartDate'];?></label><br>
<label for="ContractEndDate">End Date:&nbsp;<?=$customerInfo['ContractEndDate'];?></label><br>
<label for="ContractTermLength">Term Length:&nbsp;<?=$customerInfo['TermLength'];?>&nbsp;Months</label><br>
<?php //Region name depends on what ZipCode is entered?>