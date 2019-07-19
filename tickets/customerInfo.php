<?php 
include '../model/users_database.php';
$customer = null;
if( isset($_POST['UserID']) ) {
    $userID = filter_input(INPUT_POST, 'UserID', FILTER_VALIDATE_INT);
    $customer = getCustomer($userID);
}

$pattern = '/(\w{3})(\w{3})(\w{4})/';
$replace = '($1) $2-$3';

if($customer !== null) {
    echo "<label for='customerEmail'>Email:&nbsp;" . $customer['Email'] . "</label><br>";
    echo "<label for='customerPhone'>Phone:&nbsp;" . preg_replace( $pattern, $replace, $customer['Phone'] ) . "</label><br>";
    echo "<label for='customerStreet'>Street Address:&nbsp;" . $customer['StreetAddr'] . "</label><br>";
    echo "<label for='customerCityState'>City, State:&nbsp;" . $customer['City'] . ", " . $customer['State'] . "</label><br>";
    echo "<label for='customerZipcode'>Zip Code:&nbsp;" . $customer['ZIPCode'] . "</label><br>";
    echo "<label for='customerRegion'>Region:&nbsp;" . $customer['RegionName'] . "</label><br>";
    echo "<label for='customerVIP'>VIP Status:&nbsp;" . ($customer['VIP'] ? 'Yes' : 'No') . "</label><br>";
}
?>