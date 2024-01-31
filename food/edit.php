<?php
include "../connect.php";
$id = filterRequest("id");
$name = filterRequest("name");
$image = uploadImage($_FILES["file"]);
 


$stmt = $con->prepare("UPDATE category SET name= ? , image=?  WHERE id=?");


$stmt->execute(array($name, $image, $id));

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {

    echo json_encode(array("status" => "fail"));
}