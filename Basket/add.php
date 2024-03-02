<?php
include "../connect.php";
$ClientID = filterRequest("ClientID");
$Price = filterRequest("Price");
$DateTime = filterRequest("DateTime");
$received_date = filterRequest("received_date");
$MenuItemID = filterRequest("MenuItemID");
$quantity = filterRequest("quantity");
 


$stmt = $con->prepare("INSERT INTO `menuitemsclient`(`ClientID`, `Price`, `DateTime`, `received_date`, `MenuItemID`, `quantity`) VALUES ('$ClientID','$Price','$DateTime','$received_date','$MenuItemID','$quantity')");


$stmt->execute();

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {

    echo json_encode(array("status" => "fail"));
}