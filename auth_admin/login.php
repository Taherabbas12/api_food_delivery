<?php
include "../connect.php";
$email = filterRequest("email");
$password = filterRequest("password");

$stmt = $con->prepare("SELECT name,email,phone FROM admin WHERE password= ?  AND email= ?");


$stmt->execute(array($password, $email));
 

$count = $stmt->rowCount();


if ($count > 0) {

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(array("status" => "success" ,"data"=>$data));
} else {

    echo json_encode(array("status" => "fail"));
}