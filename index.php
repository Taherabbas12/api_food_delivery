<?php
include "connect.php";
//  prepare كتب هنا تعليمة الSQL
$stmt = $con->prepare("SELECT * FROM users");

// execute هنا يتم تنفيذ  التعليمة
$stmt->execute();

// fetchAll هنا يتم تخزين كل البيانات الموجودة بقاعدة البيانات 
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($users);