<?php
include 'connect.db'; // kết nối database
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: login.php");
    exit();
}

// Lấy tất cả sản phẩm từ CSDL
$sql = "SELECT * FROM sanpham ORDER BY MaSP ASC";
$result = mysqli_query($conn, $sql);

// Map ảnh theo MaSP (folder img/)
$anh_sanpham = [
    1 => 'image/Screenshot 2025-01-18 204052.png',
    2 => 'image/Screenshot 2025-01-18 204241.png',
    3 => 'image/Screenshot 2025-01-16 111226.png',
    4 => 'image/Screenshot_2025-01-16-09-39-46-429_com.android.chrome-edit.jpg',
    5 => 'image/Screenshot 2025-01-18 204355.png',
    6 => 'image/Screenshot 2025-01-17 134016.png',
    7 => 'image/Screenshot 2025-01-17 134605.png',
    8 => 'image/Screenshot 2025-01-17 141014.png',
    9 => 'image/Screenshot 2025-01-17 233528.png',
    10 => 'image/Screenshot 2025-01-17 234115.png',
    11 => 'image/Screenshot 2025-01-18 203437.png',
    12 => 'image/Screenshot 2025-01-18 203801.png',
    13 => 'image/Screenshot 2025-01-18 204703.png',
    14 =>'image/Screenshot 2025-01-18 205051.png',
    15 =>'image/Screenshot 2025-01-18 205354.png',
];
?>

<!doctype html>
<html lang="vi">
<head>
<meta charset="utf-8">
<title>Admin - Quản lý sản phẩm</title>
<link rel="stylesheet" type="text/css" href="style.css">
<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
}
.header-bar {

    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.header-bar h1 {
    color: #fff; /* chữ màu trắng */
}
.logout-btn {
    background: #dc3545;
    color: #fff;
    padding: 10px 15px;
    border-radius: 5px;
    text-decoration: none;
    transition: 0.3s;
}
.logout-btn:hover {
    background: #b02a37;
}
.product-list { display: flex; flex-wrap: wrap; gap: 20px; }
.product-item { border: 1px solid #ccc; padding: 10px; width: 220px; position: relative; text-align: center; transition: transform 0.2s; }
.product-item:hover { transform: scale(1.05); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
.product-item img { width: 200px; height: 220px; object-fit: cover; }
.product-name { font-weight: bold; margin: 5px 0; }
.product-price { color: #e91e63; font-weight: bold; margin: 5px 0; }
.btn-buy, .btn-edit, .btn-delete { display: inline-block; margin: 3px; padding: 5px 10px; text-decoration: none; color: #fff; border-radius: 4px; font-size: 14px; }
.btn-buy { background: #28a745; }
.btn-edit { background: #007bff; }
.btn-delete { background: #dc3545; }
.product-label.hot { position: absolute; top: 5px; left: 5px; background: red; color: #fff; padding: 2px 5px; font-size: 12px; }
</style>
</head>
<body>

<div class="header-bar">
    <h1>Quản lý sản phẩm</h1>
    <a href="index.html" class="logout-btn">Đăng xuất</a>
</div>

<a href="them_sanpham.php" style="margin-bottom:20px; display:inline-block; background:#007bff; color:#fff; padding:10px 15px; text-decoration:none; border-radius:4px;">Thêm sản phẩm mới</a>

<div class="product-list">
<?php while($row = mysqli_fetch_assoc($result)): ?>
    <div class="product-item">
        <?php if(!empty($row['Hot'])): ?>
            <span class="product-label hot">Hot</span>
        <?php endif; ?>
        <img src="<?php echo htmlspecialchars($row['Anh']); ?>" 
     alt="<?php echo htmlspecialchars($row['TenSP']); ?>">

        <div class="product-name"><?php echo htmlspecialchars($row['TenSP']); ?></div>
        <div class="product-price"><?php echo number_format($row['Gia'],0,",","."); ?>đ</div>
        <a href="giohang.php?id=<?php echo $row['MaSP']; ?>" class="btn-buy">MUA</a>
        <a href="sua_sanpham.php?id=<?php echo $row['MaSP']; ?>" class="btn-edit">Sửa</a>
        <a href="xoa_sanpham.php?id=<?php echo $row['MaSP']; ?>" class="btn-delete" onclick="return confirm('Xóa sản phẩm này?')">Xóa</a>
    </div>
<?php endwhile; ?>
</div>

</body>
</html>
