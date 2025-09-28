<?php
include 'connect.db';

// mốc thời gian bạn muốn lấy sản phẩm từ đó trở đi
$moc = "2025-08-20 20:52:10";

$sql = "SELECT * FROM sanpham WHERE NgayNhap >= ? ORDER BY NgayNhap DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $moc);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
echo json_encode($products, JSON_UNESCAPED_UNICODE);
?>
