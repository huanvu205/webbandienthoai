<?php
include 'connect.db';
session_start();
if (!isset($_SESSION['admin'])) { header("Location: login.php"); exit(); }

$id = $_GET['id'] ?? 0;
$sql = "SELECT * FROM sanpham WHERE MaSP=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten  = $_POST['TenSP'];
    $gia  = preg_replace('/[^\d]/', '', $_POST['Gia']); // loại bỏ dấu chấm, phẩy
    $mota = $_POST['MoTa'];

    // xử lý ảnh
    if (!empty($_FILES['Anh']['name'])) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
        $fileName = time() . "_" . basename($_FILES["Anh"]["name"]);
        $targetFile = $targetDir . $fileName;
        move_uploaded_file($_FILES["Anh"]["tmp_name"], $targetFile);
        $anh = $targetFile;
    } else {
        $anh = $row['Anh']; // giữ ảnh cũ nếu không chọn
    }

    $update = "UPDATE sanpham SET TenSP='$ten', Gia='$gia', MoTa='$mota', Anh='$anh' WHERE MaSP=$id";
    mysqli_query($conn, $update);
    header("Location: admin.php"); exit();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Sửa sản phẩm</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  body { background: #f8f9fa; }
  .card { border-radius: 15px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
  .btn-success { background: linear-gradient(45deg, #28a745, #20c997); border: none; }
  .btn-success:hover { background: linear-gradient(45deg, #20c997, #28a745); }
  .form-label { font-weight: 600; }
</style>
</head>
<body>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card p-4">
        <h3 class="text-center text-primary mb-4">✏️ Sửa sản phẩm</h3>
        <form method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label class="form-label">Tên sản phẩm</label>
            <input type="text" name="TenSP" class="form-control" value="<?= htmlspecialchars($row['TenSP']) ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Giá</label>
            <input type="text" name="Gia" class="form-control" 
                   value="<?= number_format($row['Gia'], 0, ',', '.') ?>" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Ảnh sản phẩm</label><br>
            <img src="<?= htmlspecialchars($row['Anh']) ?>" alt="Ảnh" width="120" class="rounded mb-2">
            <input type="file" name="Anh" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Mô tả</label>
            <textarea name="MoTa" rows="3" class="form-control"><?= htmlspecialchars($row['MoTa']) ?></textarea>
          </div>
          <div class="d-flex justify-content-between">
            <a href="admin.php" class="btn btn-secondary">⬅️ Quay lại</a>
            <button type="submit" class="btn btn-success">💾 Cập nhật</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
