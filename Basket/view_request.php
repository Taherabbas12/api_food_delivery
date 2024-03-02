<?php
include "../connect.php";

$ClientID = filterRequest("ClientID");
 
$stmt = $con->prepare("SELECT * FROM `menuitemsclient` where ClientID=? and received_date='قيد الانتضار'");


$stmt->execute(array($ClientID));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success", "data" => $data));
} else {

    echo json_encode(array("status" => "fail"));
}