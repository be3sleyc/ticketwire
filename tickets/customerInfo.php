<?php 
include '../model/users_database.php';
$customer = null;
if( isset($_POST['UserID']) ) {
    $userID = filter_input(INPUT_POST, 'UserID', FILTER_VALIDATE_INT);
    $customer = getCustomer($userID);
}

$pattern = '/(\w{3})(\w{3})(\w{4})/';
$replace = '($1)$2-$3';

if($customer !== null) {
    echo "<label for='customerEmail'>Email:</label>";
    echo "<input type='text' name='customerEmail' id='customerEmail' size='30' value=" . $customer['Email'] . " readonly><br>";
    echo "<label for='customerPhone'>Phone:</label>";
    echo "<input type='text' name='customerPhone' id='customerPhone'  size='13' value=" . preg_replace( $pattern, $replace, $customer['Phone'] ) . " readonly><br>";
    echo "<label for='customerStreet'>Street Address:</label>";
    echo "<input type='text' name='customerStreet' id='customerStreet' value=" . $customer['StreetAddr'] . " readonly><br>";
    echo "<input type='text' name='customerCity' id='customerCity' value=" . $customer['City'] . " readonly>,&nbsp;";
    echo "<input type='text' name='customerState' id='customerState' size='2' value=" . $customer['State'] . " readonly>&nbsp;";
    echo "<input type='text' name='customerZIP' id='customerZIP' size='5' value=" . $customer['ZIPCode'] . " readonly><br>";
    echo "<label for='customerRegion'>Region:</label>";
    echo "<input type='text' name='customerRegion' id='customerRegion' value=" . $customer['RegionName'] . " readonly><br>";
    echo "<label for='customerVIP'>VIP Status:</label>";
    echo "<input type='text' name='customerVIP' id='customerVIP' size='1' value=" . $customer['VIP'] . " readonly><br>";
}
?>