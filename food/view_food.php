<?php
include "../connect.php";


$Category = filterRequest("Category");
 

$stmt = $con->prepare("
    SELECT m.MenuItemID, m.Name AS MenuItemName ,m.*, GROUP_CONCAT(i.url_image) AS Images
    FROM menuitems m 
    LEFT JOIN images i ON m.MenuItemID = i.id_items
    WHERE m.Category = ?  
    GROUP BY m.MenuItemID, m.Name
");
 
$stmt->execute(array($Category));

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

$count = $stmt->rowCount();

if ($count > 0) {
    foreach ($data as &$row) {
        // تقسيم النص في الحقل "Images" إلى عناوين فردية باستخدام الفاصل ","
        $row["Images"] = explode(",", $row["Images"]);
    }
    echo json_encode(array("status" => "success", "data" => $data));
} else {
    echo json_encode(array("status" => "fail"));
}
?>