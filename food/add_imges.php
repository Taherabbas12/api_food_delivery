<?php
include "../connect.php";




$id_items = filterRequest("id_items");
$image = uploadImage2('file');
 
// $image = $uploadImages('isAvailable');

 
    $stmt = $con->prepare("INSERT INTO images SET id_items= ? , url_image=?");
    $stmt->execute(array($id_items, $image ));
 


 

$count = $stmt->rowCount();

if ($count > 0) {

 
 
    echo json_encode(array("status" => "success"));

 
} else {

    echo json_encode(array("status" => "fail"));
}

