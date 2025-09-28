<?php
include "connect.db"; // file kết nối CSDL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hoten = $_POST['hoten'];
    $email = $_POST['email'];
    $sdt   = $_POST['sdt'];
    $diachi = $_POST['diachi'];
   $matkhau = $_POST['matkhau'];  // Lưu trực tiếp, KHÔNG mã hóa


    $sql = "INSERT INTO khachhang (HoTen, Email, SoDienThoai, DiaChi, MatKhau) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $hoten, $email, $sdt, $diachi, $matkhau);

    if ($stmt->execute()) {
        echo "<script>alert('Đăng ký thành công!'); window.location='login.php';</script>";
    } else {
        echo "Lỗi: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng ký</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: linear-gradient(to right, #11998e, #38ef7d);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .register-box {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0px 4px 10px rgba(0,0,0,0.2);
      width: 350px;
      text-align: center;
    }
    .register-box h2 {
      margin-bottom: 20px;
    }
    .register-box input {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .register-box button {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      color: #fff;
      font-weight: bold;
      background: linear-gradient(to right, #00b09b, #96c93d);
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="register-box">
    <h2>Đăng ký tài khoản</h2>
    <form method="post">
      <input type="text" name="hoten" placeholder="Họ tên" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="sdt" placeholder="Số điện thoại" required>
      <input type="text" name="diachi" placeholder="Địa chỉ" required>
      <input type="password" name="matkhau" placeholder="Mật khẩu" required>
      <button type="submit">Đăng ký</button>
    </form>
  </div>
</body>
</html>
