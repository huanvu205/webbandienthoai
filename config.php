<?php
$servername = "localhost";
$username   = "root";   // user mặc định của XAMPP
$password   = "";       // mật khẩu mặc định rỗng
$database   = "ten_database_cua_ban"; 

// Kết nối
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
