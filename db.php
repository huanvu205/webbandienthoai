<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'csdl_doan';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
// echo "Kết nối thành công"; // Chỉ để test, có thể bỏ
?>
