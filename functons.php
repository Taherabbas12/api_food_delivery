<?php
function filterRequest($requestname)
{
    return htmlspecialchars(strip_tags($_POST[$requestname]));
}


 function uploadImage($file,$name)
{
    // تحديد مسار المجلد لتخزين الصور داخل المشروع
    $uploadDir = '../uploads/' . $name . '/';

    // التحقق من نوع الصورة
    $allowedTypes = array("image/jpeg", "image/png", "image/gif","image/jpg",);
    if (!in_array($file['type'], $allowedTypes)) {
        return false; // نوع الصورة غير مسموح
    }

    // // التحقق من حجم الصورة (حدد الحجم حسب احتياجاتك)
    // $maxFileSize = 5 * 1024 * 1024; // 5 MB
    // if ($file['size'] > $maxFileSize) {
    //     return false; // حجم الصورة كبير جداً
    // }

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
    $uploadDir = '../uploads/' . $name . '/';

    // التحقق من نوع الصورة
    // $allowedTypes = array("image/jpeg", "image/png", "image/gif");
    // if (!in_array($file['type'], $allowedTypes)) {
    //     return false; // نوع الصورة غير مسموح
    // }

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



define("MB",1048576);
function uploadImage2($imageRequest){
    global $msgError;
    $imageName = rand(1000,10000).$_FILES[$imageRequest]['name'];
    $imageTmp =$_FILES[$imageRequest]['tmp_name'];
    $imageSize =$_FILES[$imageRequest]['size'];
    // $allowExt  =array("jpg","png","gif","mp3","pdf");
    $strToArray = explode(".",$imageName);
    $ext        = end($strToArray);
    $ext        =strtolower($ext);
    // if(!empty($imageName)&&!in_array($ext ,$allowExt)){
    //     $msgError[]="Ext";
    // }
    // if($imageSize>5 & MB){
    //     $msgError="Size";
    // }
    if(empty($msgError)){
        move_uploaded_file($imageTmp,"../uploads/food/".$imageName);
        return "uploads/food/".$imageName;
    }
    else {
        return "fail";
        echo "<pre>";
        print_r($msgError);
        echo "</pre>";
    }
}


function uploadImages($imageRequests){
    global $msgError;
    $uploadedImages = array();

    foreach ($imageRequests['name'] as $key => $imageName) {
        $imageName = rand(1000, 10000) . $imageName;
        $imageTmp = $imageRequests['tmp_name'][$key];
        $imageSize = $imageRequests['size'][$key];
        $allowExt = array("jpg", "png", "gif", "mp3", "pdf");
        $strToArray = explode(".", $imageName);
        $ext = end($strToArray);
        $ext = strtolower($ext);

        if (!empty($imageName) && !in_array($ext, $allowExt)) {
            $msgError[] = "Ext";
        }
        
        if ($imageSize > 5 * MB) {
            $msgError[] = "Size";
        }

        if (empty($msgError)) {
            $uploadPath = "../uploads/food/" . $imageName;
            move_uploaded_file($imageTmp, $uploadPath);
            $uploadedImages[] = $uploadPath;
        }
    }

    if (!empty($msgError)) {
        return "fail";
        echo "<pre>";
        print_r($msgError);
        echo "</pre>";
    } else {
        return $uploadedImages;
    }
}

?>