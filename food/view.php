<?php
include "../connect.php";

$stmt = $con->prepare("
    SELECT m.MenuItemID, m.Name AS MenuItemName, GROUP_CONCAT(i.url_image) AS Images
    FROM menuitems m
    LEFT JOIN images i ON m.MenuItemID = i.id_items
    GROUP BY m.MenuItemID, m.Name
");

$stmt->execute();

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
