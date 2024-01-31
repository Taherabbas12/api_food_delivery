<?php
include "../connect.php";
$Name = filterRequest("Name");
$Description = filterRequest('Description');
$Price = filterRequest("Price");
$Category = filterRequest('Category');
$isAvailable = filterRequest('isAvailable');
// $image = $uploadImages('isAvailable');


$stmt = $con->prepare("INSERT INTO menuitems SET Name= ? , Description=?, Price=?, Category=?, isAvailable=?");

$stmt->execute(array($Name, $Description, $Price, $Category, $isAvailable));

$count = $stmt->rowCount();

if ($count > 0) {


$stmt2 = $con->prepare("SELECT * FROM `menuitems` where Name=? ");


$stmt2->execute(array($Name));

$data = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt2->rowCount();

 
    echo json_encode(array("status" => "success", "data" => $data));

 
} else {

    echo json_encode(array("status" => "fail"));
}