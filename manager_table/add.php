<?php
include "../connect.php";
$name = filterRequest("name");
$age = filterRequest("age");
$department = filterRequest("department");


$stmt = $con->prepare("INSERT INTO students SET name= ? , age=? , department=?");


$stmt->execute(array($name, $age, $department));

$count = $stmt->rowCount();

if ($count > 0) {
    echo json_encode(array("status" => "success"));
} else {

    echo json_encode(array("status" => "fail"));
}