<?php
require 'db.php';

$sql = "SELECT * FROM sanpham";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
     echo "Tên: " . $row["TenSP"] . " - Giá: " . number_format($row["Gia"], 0, ',', '.') . " đ<br>";


    }
} else {
    echo "Không có sản phẩm nào";
}
$conn->close();
?>
