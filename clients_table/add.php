<?php
include "../connect.php";
$c_name = filterRequest("c_name");
$c_phone_number = filterRequest("c_phone_number");
$c_address = filterRequest("c_address");
$c_restOfMoney = filterRequest("c_restOfMoney");
$manager_name = filterRequest("manager_name");


$stmt = $con->prepare("INSERT INTO clients_table SET name= ? , phone_number=? , address=?, restOfMoney=?, manager_name=?");


$stmt->execute(array($c_name, $c_phone_number, $c_address,$c_restOfMoney, $manager_name));

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {

    echo json_encode(array("status" => "fail"));
}