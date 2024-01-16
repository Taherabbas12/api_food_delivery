<?php
include "../connect.php";
$name = filterRequest("name");
$email = filterRequest("email");
$password = filterRequest("password");
$phone = filterRequest("phone");

$stmt = $con->prepare("INSERT INTO users SET name='$name',email='$email',password='$password',phone='$phone'");

$stmt->execute();

$count = $stmt->rowCount();


if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {

    echo json_encode(array("status" => "fail"));
}