<?php
$conn = new mysqli(
    "sql207.infinityfree.com",   // Database Host
    "if0_39800571",              // Username
    "WteOfs2nEhHVDW",            // Password
    "if0_39800571_webcntt"       // Database Name
);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
// echo "✅ Kết nối thành công!";
?>
