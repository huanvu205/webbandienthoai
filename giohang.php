<?php
// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "csdl_doan");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$id = $_GET['id'] ?? 0;
$sql = "SELECT * FROM sanpham WHERE MaSP = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$sp = $result->fetch_assoc();
if (!$sp) {
    die("Không tìm thấy sản phẩm.");
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Giỏ hàng</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body { font-family: Arial, sans-serif; background: #f4f6f8; margin:0; padding:20px; }
.container { max-width: 600px; background: #fff; padding: 20px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin:auto; }
h2 { text-align:center; color:#333; }
.product { display: flex; align-items: center; justify-content: space-between; padding: 15px; border-bottom: 1px solid #ddd; }
.product-info { flex: 1; }
label { display:block; margin-top:10px; font-weight:bold; }
input, select { width: 100%; padding: 8px; margin-top: 5px; border-radius: 6px; border: 1px solid #ccc; }
button { margin-top: 15px; padding: 12px; width: 100%; background: #28a745; color:#fff; border:none; border-radius: 8px; font-size: 16px; cursor:pointer; transition: 0.3s; }
button:hover { background: #218838; transform: scale(1.03); }
</style>
</head>
<body>
<div class="container">
    <h2><i class="fas fa-shopping-cart"></i> Xác nhận mua hàng</h2>
    <div class="product">
        <div class="product-info">
            <strong><?php echo $sp['TenSP']; ?></strong><br>
            Giá: <span style="color:red;"><?php echo number_format($sp['Gia'], 0, ',', '.'); ?> đ</span>
        </div>
    </div>
    <form action="hoadon.php" method="POST">
        <input type="hidden" name="MaSP" value="<?php echo $sp['MaSP']; ?>">
        <input type="hidden" name="TenSP" value="<?php echo $sp['TenSP']; ?>">
        <input type="hidden" name="Gia" value="<?php echo $sp['Gia']; ?>">

        <label><i class="fas fa-user"></i> Tên khách hàng</label>
        <input type="text" name="TenKH" required>

        <label><i class="fas fa-phone"></i> Số điện thoại</label>
        <input type="text" name="SDT" required>

        <label><i class="fas fa-map-marker-alt"></i> Địa chỉ</label>
        <input type="text" name="DiaChi" required>

        <label><i class="fas fa-truck"></i> Đơn vị vận chuyển</label>
        <select name="VanChuyen">
            <option value="Giao hàng nhanh">Giao hàng nhanh</option>
            <option value="Giao hàng tiết kiệm">Giao hàng tiết kiệm</option>
            <option value="Viettel Post">Viettel Post</option>
        </select>

        <label><i class="fas fa-credit-card"></i> Phương thức thanh toán</label>
        <select name="ThanhToan">
            <option value="Thanh toán khi nhận hàng">Thanh toán khi nhận hàng</option>
            <option value="Chuyển khoản ngân hàng">Chuyển khoản ngân hàng</option>
            <option value="Ví điện tử">Ví điện tử</option>
        </select>

        <button type="submit"><i class="fas fa-check"></i> Xác nhận mua</button>
    </form>
</div>
</body>
</html>
