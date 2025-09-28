<?php
session_start();
include "connect.db"; // Kết nối CSDL

// Nếu đã login thì không cho vào lại login nữa
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    header("Location: admin.php");
    exit();
}
if (isset($_SESSION['khachhang'])) {
    header("Location: trangchu.php");
    exit();
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // ===== Check Admin =====
    $sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result && $result->num_rows === 1) {
            session_regenerate_id(true);
            $_SESSION['admin'] = true;
            $stmt->close();
            header("Location: admin.php");
            exit();
        }
        $stmt->close();
    }

  // ===== Check Khách Hàng (hỗ trợ cả plain & hash) =====
$sql = "SELECT * FROM khachhang WHERE LOWER(Email) = LOWER(?)";
$stmt = $conn->prepare($sql);

if ($stmt) {
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
    echo "Debug: Không tìm thấy email [$username] trong DB!<br>";
}

    if ($result && $result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $db_password = $row['MatKhau'];

        $isValid = false;

        // Nếu mật khẩu trong DB là hash (bắt đầu bằng $2y$...)
        if (strpos($db_password, '$2y$') === 0) {
            $isValid = password_verify($password, $db_password);
        } else {
            // Nếu là plain text
            $isValid = ($password === $db_password);
        }

        if ($isValid) {
            session_regenerate_id(true);
            $_SESSION['khachhang'] = $row;
            header("Location: trangchu.php");
            exit();
        } else {
            $error = "❌ Mật khẩu không đúng!";
        }
    } else {
        $error = "❌ Tài khoản không tồn tại!";
    }

    $stmt->close();
}
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 4px 20px rgba(0,0,0,0.2);
            animation: fadeIn 1s ease-in-out;
        }
        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }
        .btn-custom {
            background: linear-gradient(to right, #ff4b2b, #ff416c);
            border: none;
            color: white;
            transition: all 0.3s ease;
        }
        .btn-custom:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(255,65,108,0.5);
        }
        .register-btn {
            margin-top: 10px;
            width: 100%;
            border: none;
            border-radius: 8px;
            padding: 10px;
            background: #6c63ff;
            color: white;
            cursor: pointer;
        }
        .register-btn:hover {
            background: #5750d9;
        }
    </style>
</head>
<body>
    <div class="login-box col-md-4">
        <h3 class="text-center mb-4">Đăng nhập</h3>
        <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Tên đăng nhập (Email / Admin)</label>
                <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-custom w-100">Đăng nhập</button>
        </form>
        <form action="register.php" method="get">
            <button type="submit" class="register-btn">Đăng ký</button>
        </form>
    </div>
</body>
</html>
