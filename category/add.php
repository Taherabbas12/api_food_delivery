<?php
include "../connect.php";
$name = filterRequest("name");
$image = uploadImage2('file');


$stmt = $con->prepare("INSERT INTO category SET name= ? , image=?");

$stmt->execute(array($name, $image));

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {

    echo json_encode(array("status" => "fail"));
}