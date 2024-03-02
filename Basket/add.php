<?php
include "../connect.php";

// Assuming `filterRequest` is a custom function for filtering inputs
// Make sure to properly define and implement this function for security purposes

$ClientID = filterRequest("ClientID");
$Price = filterRequest("Price");
$DateTime = filterRequest("DateTime");
$received_date = filterRequest("received_date");
$MenuItemName = filterRequest("MenuItemName");
$quantity = filterRequest("quantity");

// Using prepared statements to prevent SQL injection
// $stmt = $con->prepare("INSERT INTO `menuitemsclient` (`ClientID`, `Price`, `DateTime`, `received_date`, `MenuItemID`, `quantity`) VALUES (?, ?, ?, ?, ?, ?)");

$stmt = $con->prepare("INSERT INTO menuitemsclient SET ClientID=?, Price=?, DateTime=?, received_date=?, quantity=?, MenuItemName=?");

$stmt->execute(array($ClientID, $Price, $DateTime, $received_date, $quantity, $MenuItemName));

$count = $stmt->rowCount();

if ($count > 0) {

    echo json_encode(array("status" => "success"));

 
} else {

    echo json_encode(array("status" => "fail"));
}