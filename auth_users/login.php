<?php
include "../connect.php";
$username = filterRequest("user_name");
$password = filterRequest("password");

$stmt = $con->prepare("SELECT * FROM admin WHERE password= ?  AND user_name= ?");


$stmt->execute(array($password, $username));

$count = $stmt->rowCount();


if ($count > 0) {
    echo json_encode(array("status" => "success", array($stmt["id"])));
} else {

    echo json_encode(array("status" => "fail"));
}