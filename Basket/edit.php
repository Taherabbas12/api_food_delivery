<?php
include "../connect.php";
$menuitemsclientID = filterRequest("menuitemsclientID");
 
 

 
$stmt = $con->prepare("UPDATE menuitemsclient SET  received_date='قيد الانتضار' WHERE menuitemsclientID=?");


$stmt->execute(array($menuitemsclientID));

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {

    echo json_encode(array("status" => "fail"));
}