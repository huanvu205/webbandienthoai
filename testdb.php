<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("sql207.infinityfree.com", "if0_39800571", "WteOfs2nEhHVDW", "if0_39800571_webcntt");

if ($conn->connect_error) {
    die("❌ Kết nối thất bại: " . $conn->connect_error);
}

echo "✅ Kết nối database thành công!";
?>
