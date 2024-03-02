<?php
include "../connect.php";
$id = filterRequest("id");
$name = filterRequest("name");
$age = filterRequest("age");
$department = filterRequest("department");


$stmt = $con->prepare("UPDATE students SET name= ? , age=? , department=? WHERE id=?");


$stmt->execute(array($name, $age, $department, $id));

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {

    echo json_encode(array("status" => "fail"));
}