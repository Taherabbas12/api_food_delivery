<?php
include "../connect.php";
$item_name = filterRequest("item_name");
$item_restOfIt = filterRequest("item_restOfIt");
$item_price = filterRequest("item_price");
$item_desc = filterRequest("item_desc");
 


$stmt = $con->prepare("INSERT INTO `items_table`(`item_name`, `item_restOfIt`, `item_price`, `item_desc`) VALUES ('$item_name','$item_restOfIt','$item_price','$item_desc')");


$stmt->execute();

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {

    echo json_encode(array("status" => "fail"));
}