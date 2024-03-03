<?php
include "../connect.php";
$email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);

$stmt = $con->prepare("SELECT id,name,email,phone FROM users WHERE password = ? AND email = ?");
$stmt->execute(array($password, $email));
$count = $stmt->rowCount();

if ($count > 0) {
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "fail"));
}
?>
