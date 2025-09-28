<?php
include 'connect.db'; // Kết nối CSDL

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten = $_POST['ten'];
    $gia = $_POST['gia'];

    if (isset($_FILES['anh']) && $_FILES['anh']['error'] == 0) {
        $ten_file = $_FILES['anh']['name'];
        $tmp_file = $_FILES['anh']['tmp_name'];

        $thu_muc = 'img/';
        if (!file_exists($thu_muc)) mkdir($thu_muc, 0777, true);

        move_uploaded_file($tmp_file, $thu_muc . $ten_file);

        $duongdan = 'img/' . $ten_file;

        $sql = "INSERT INTO sanpham (TenSP, Gia, Anh) VALUES ('$ten', '$gia', '$duongdan')";
        mysqli_query($conn, $sql);

        // Redirect về admin.php sau khi thêm
        header("Location: admin.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Thêm sản phẩm mới</title>
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background: #fff;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
    width: 400px;
    text-align: center;
    transition: transform 0.3s;
}

.container:hover {
    transform: translateY(-5px);
}

h1 {
    margin-bottom: 25px;
    color: #333;
    font-size: 24px;
    text-shadow: 1px 1px 2px #aaa;
}

form label {
    display: block;
    text-align: left;
    margin: 10px 0 5px;
    font-weight: bold;
    color: #555;
}

form input[type="text"],
form input[type="number"],
form input[type="file"] {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-bottom: 15px;
    transition: 0.3s;
}

form input[type="text"]:focus,
form input[type="number"]:focus,
form input[type="file"]:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0,123,255,0.5);
    outline: none;
}

button {
    background: linear-gradient(45deg, #007bff, #00d4ff);
    border: none;
    color: #fff;
    padding: 12px 25px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 16px;
    transition: 0.3s;
}

button:hover {
    background: linear-gradient(45deg, #00d4ff, #007bff);
    transform: scale(1.05);
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

a.back-btn {
    display: inline-block;
    margin-top: 15px;
    text-decoration: none;
    color: #007bff;
    font-weight: bold;
    transition: 0.3s;
}

a.back-btn:hover {
    color: #00d4ff;
}
</style>
</head>
<body>
<div class="container">
    <h1>Thêm sản phẩm mới</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Tên sản phẩm:</label>
        <input type="text" name="ten" placeholder="Nhập tên sản phẩm..." required>

        <label>Giá:</label>
        <input type="number" name="gia" placeholder="Nhập giá sản phẩm..." required>

        <label>Ảnh sản phẩm:</label>
        <input type="file" name="anh" accept="image/*" required>

        <button type="submit">Thêm sản phẩm</button>
    </form>
    <a href="admin.php" class="back-btn">« Quay lại quản lý sản phẩm</a>
</div>
</body>
</html>
