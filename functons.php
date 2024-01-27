<?php
function filterRequest($requestname)
{
    return htmlspecialchars(strip_tags($_POST[$requestname]));
}


 function uploadImage($file)
{
    // تحديد مسار المجلد لتخزين الصور داخل المشروع
    $uploadDir = __DIR__ . '/uploads/';

    // التحقق من نوع الصورة
    $allowedTypes = array("image/jpeg", "image/png", "image/gif");
    if (!in_array($file['type'], $allowedTypes)) {
        return false; // نوع الصورة غير مسموح
    }

    // التحقق من حجم الصورة (حدد الحجم حسب احتياجاتك)
    $maxFileSize = 5 * 1024 * 1024; // 5 MB
    if ($file['size'] > $maxFileSize) {
        return false; // حجم الصورة كبير جداً
    }

    // معالجة الصورة (يمكنك إضافة معالجة إضافية هنا)

    // رفع الصورة إلى المجلد المحدد
    $targetPath = $uploadDir . basename($file['name']);
    if (!move_uploaded_file($file['tmp_name'], $targetPath)) {
        return false; // فشل في نقل الملف
    }

    return $targetPath; // إرجاع المسار الذي تم حفظ الصورة فيه داخل المشروع
}









 

// دالة لرفع وضغط الصورة
function uploadAndCompressImage($file,$name)
{
    // تحديد مسار المجلد لتخزين الصور داخل المشروع
    $uploadDir =  '../uploads/' . $name . '/';

    // التحقق من نوع الصورة
    $allowedTypes = array("image/jpeg", "image/png", "image/gif");
    if (!in_array($file['type'], $allowedTypes)) {
        return false; // نوع الصورة غير مسموح
    }

    // التحقق من حجم الصورة (حدد الحجم حسب احتياجاتك)
    $maxFileSize = 5 * 1024 * 1024; // 5 MB
    if ($file['size'] > $maxFileSize) {
        return false; // حجم الصورة كبير جداً
    }

    // قم بفحص نوع الصورة واستخدام المكتبة المناسبة لضغطها
    switch ($file['type']) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($file['tmp_name']);
            break;
        case 'image/png':
            $image = imagecreatefrompng($file['tmp_name']);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($file['tmp_name']);
            break;
        default:
            return false; // نوع الصورة غير معتمد
    }

    // قم بتحديد جودة الضغط (تحديدها وفقًا لاحتياجاتك)
    $compressionQuality = 60;

    // قم بحفظ الصورة المضغوطة في المجلد المحدد
    $targetPath = $uploadDir . basename($file['name']);
    switch ($file['type']) {
        case 'image/jpeg':
            imagejpeg($image, $targetPath, $compressionQuality);
            break;
        case 'image/png':
            imagepng($image, $targetPath, round(9 * $compressionQuality / 100));
            break;
        case 'image/gif':
            imagegif($image, $targetPath);
            break;
    }

    // تحرير الذاكرة
    imagedestroy($image);

    return $targetPath; // إرجاع المسار الذي تم حفظ الصورة فيه داخل المشروع
}

?>

 