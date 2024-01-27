<?php
include "../connect.php";

$name = filterRequest("name");
$email = filterRequest("email");
$password = filterRequest("password");
$phone = filterRequest("phone");
$imagePath = uploadAndCompressImage($_FILES['file'],'admin');

 
// التحقق من وجود الحساب باستخدام البريد الإلكتروني
$checkStmt = $con->prepare("SELECT COUNT(*) as count FROM admin WHERE email=:email");
$checkStmt->bindParam(":email", $email);
$checkStmt->execute();
$result = $checkStmt->fetch(PDO::FETCH_ASSOC);
$count = $result['count'];
 
if ($count > 0) {
    echo json_encode(array("status" => "fail", "message" => "الحساب موجود بالفعل"));
} else {
    // إذا لم يتم العثور على الحساب، يمكن إضافته
    $stmt = $con->prepare("INSERT INTO admin SET name=:name, email=:email, password=:password, phone=:phone,image_url=:image_url");
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":phone", $phone);
    $stmt->bindParam(":image_url", $imagePath);

    $stmt->execute();

    $insertedCount = $stmt->rowCount();

    if ($insertedCount > 0) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "fail", "message" => "فشلت عملية الإضافة"));
    }
}
?>
