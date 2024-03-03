<?php
include "../connect.php";
$name = filterRequest("name");
$email = filterRequest("email");
$password = filterRequest("password");
$phone = filterRequest("phone");

$stmt = $con->prepare("INSERT INTO users SET name='$name',email='$email',password='$password',phone='$phone'");

$stmt->execute();

$count = $stmt->rowCount();


$stmt = $con->prepare("SELECT id,name,email,phone FROM users WHERE password = ? AND email = ?");
$stmt->execute(array($password, $email));
$count = $stmt->rowCount();
if ($count > 0) {
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(array("status" => "success", "data" => $data));
} else {

    echo json_encode(array("status" => "fail"));
}