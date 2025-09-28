<?php
$MaSP = $_POST['MaSP'] ?? '';
$TenSP = $_POST['TenSP'] ?? '';
$Gia = $_POST['Gia'] ?? 0;
$TenKH = $_POST['TenKH'] ?? '';
$SDT = $_POST['SDT'] ?? '';
$DiaChi = $_POST['DiaChi'] ?? '';
$VanChuyen = $_POST['VanChuyen'] ?? '';
$ThanhToan = $_POST['ThanhToan'] ?? '';

// Lấy ngày giờ hiện tại (đúng định dạng MySQL DATETIME)
date_default_timezone_set('Asia/Ho_Chi_Minh');
$NgayDatHang = date('Y-m-d H:i:s');

// 👉 Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "csdl_doan");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Insert dữ liệu
$SoLuong = 1;
$sql = "INSERT INTO chitietdonhang (MaSP, SoLuong, DonGia, NgayDatHang) 
        VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Lỗi prepare: " . $conn->error);
}
$stmt->bind_param("sids", $MaSP, $SoLuong, $Gia, $NgayDatHang);
$stmt->execute();

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Hóa đơn</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body { font-family: Arial, sans-serif; background: #f4f6f8; margin: 0; padding: 0; overflow: hidden; }
.invoice { max-width: 600px; background: #fff; padding: 20px; margin: 20px auto; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); position: relative; z-index: 10; }
h2 { text-align:center; color:#333; }
.info { margin: 15px 0; line-height: 1.6; }
strong { color: #333; }
.icon { color: #28a745; margin-right:8px; }
.button { display:block; width:100%; text-align:center; padding:12px; background:#007bff; color:#fff; border-radius:8px; text-decoration:none; margin-top:15px; }
.button:hover { background:#0056b3; }
.thank-you { color: #28a745; font-style: italic; text-align: center; }
#fireworksCanvas { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: 1; }
</style>
</head>
<body>
<canvas id="fireworksCanvas"></canvas>
<div class="invoice">
    <h2><i class="fas fa-file-invoice-dollar"></i> HÓA ĐƠN MUA HÀNG</h2>
    <div class="info"><i class="fas fa-user icon"></i> <strong>Khách hàng:</strong> <?php echo $TenKH; ?></div>
    <div class="info"><i class="fas fa-phone icon"></i> <strong>SĐT:</strong> <?php echo $SDT; ?></div>
    <div class="info"><i class="fas fa-map-marker-alt icon"></i> <strong>Địa chỉ:</strong> <?php echo $DiaChi; ?></div>
    <div class="info"><i class="fas fa-box icon"></i> <strong>Sản phẩm:</strong> <?php echo $TenSP; ?></div>
    <div class="info"><i class="fas fa-money-bill-wave icon"></i> <strong>Giá:</strong> <?php echo number_format($Gia, 0, ',', '.'); ?> đ</div>
    <div class="info"><i class="fas fa-truck icon"></i> <strong>Vận chuyển:</strong> <?php echo $VanChuyen; ?></div>
    <div class="info"><i class="fas fa-credit-card icon"></i> <strong>Thanh toán:</strong> <?php echo $ThanhToan; ?></div>
    <div class="info"><i class="fas fa-calendar-check icon"></i> <strong>Ngày đặt hàng:</strong> <?php echo $NgayDatHang; ?></div>
    <div class="thank-you">Cảm ơn quý khách đã ủng hộ shop! Nhận ngay ưu đãi 10% cho đơn hàng tiếp theo.</div>
    <a href="index.html" class="button"><i class="fas fa-home"></i> Quay về trang chủ</a>
</div>

<script>
const canvas = document.getElementById('fireworksCanvas');
const ctx = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

function random(min, max) {
    return Math.random() * (max - min) + min;
}

class Particle {
    constructor(x, y, hue) {
        this.x = x;
        this.y = y;
        this.hue = hue;
        this.alpha = 1;
        this.size = random(2, 6);
        this.velocity = {
            x: random(-2, 2),
            y: random(-5, -1)
        };
        this.gravity = 0.05;
        this.friction = 0.99;
    }

    draw() {
        ctx.fillStyle = `hsla(${this.hue}, 100%, 50%, ${this.alpha})`;
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
        ctx.fill();
    }

    update() {
        this.velocity.y += this.gravity;
        this.velocity.x *= this.friction;
        this.velocity.y *= this.friction;
        this.x += this.velocity.x;
        this.y += this.velocity.y;
        this.alpha -= 0.01;
    }
}

class Firework {
    constructor() {
        this.x = random(0, canvas.width);
        this.y = canvas.height;
        this.hue = random(0, 360);
        this.particles = [];
        this.exploded = false;
        this.velocity = {
            x: random(-1, 1),
            y: random(-6, -10)
        };
    }

    explode() {
        for (let i = 0; i < 100; i++) {
            this.particles.push(new Particle(this.x, this.y, this.hue));
        }
        this.exploded = true;
    }

    update() {
        if (!this.exploded) {
            this.y += this.velocity.y;
            if (this.y < canvas.height * 0.3) this.explode();
        }
        this.particles.forEach((particle, index) => {
            particle.update();
            if (particle.alpha <= 0) this.particles.splice(index, 1);
        });
    }

    draw() {
        if (!this.exploded) {
            ctx.fillStyle = `hsla(${this.hue}, 100%, 50%, 1)`;
            ctx.beginPath();
            ctx.arc(this.x, this.y, 2, 0, Math.PI * 2);
            ctx.fill();
        }
        this.particles.forEach(particle => particle.draw());
    }
}

let fireworks = [];
function animate() {
    ctx.fillStyle = 'rgba(0, 0, 0, 0.1)';
    ctx.fillRect(0, 0, canvas.width, canvas.height);
    if (Math.random() < 0.03) fireworks.push(new Firework());
    fireworks.forEach((firework, index) => {
        firework.update();
        firework.draw();
        if (firework.exploded && firework.particles.length === 0) fireworks.splice(index, 1);
    });
    requestAnimationFrame(animate);
}

animate();

window.addEventListener('resize', () => {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
});
</script>
</body>
</html>