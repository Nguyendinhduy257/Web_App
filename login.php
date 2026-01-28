<?php
// Bắt đầu session để lưu trạng thái đăng nhập
session_start();

// Nhúng file config để kết nối CSDL
include 'config.php';

// Khởi tạo biến dùng để lưu lại username khi load lại trang
$username_value = "";
$error_message = "";

// Kiểm tra xem người dùng đã bấm nút "Đăng nhập" hay chưa
if (isset($_POST['login'])) {

    // Lấy dữ liệu từ form
    $u = $_POST['username'];
    $p = $_POST['password'];

    // Gán lại username để khi đăng nhập sai trang load lại thì username vẫn còn
    $username_value = $u;

    // Câu lệnh SQL kiểm tra tài khoản (Lưu ý: nên dùng chuẩn bảo mật hơn trong thực tế)
    $sql = "SELECT * FROM tblUser WHERE username='$u' AND password='$p'";

    // Thực thi câu lệnh SQL
    $result = mysqli_query($conn, $sql);

    // Kiểm tra kết quả
    if (mysqli_num_rows($result) > 0) {
        $_SESSION['user'] = $u;
        header("Location: index.php");
        exit();
    } else {
        // Lưu thông báo lỗi vào biến thay vì echo ngay lập tức để tránh chặn render
        $error_message = "Sai tên đăng nhập hoặc mật khẩu!";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>

    <style>
        /* ===== CÀI ĐẶT CHUNG CHO BODY ===== */
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(
                120deg, #74ebd5, #163ce7, #ff920d
            );
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-size: 200% 200%;
            animation: gradientBG 15s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* ===== KHUNG ĐĂNG NHẬP ===== */
        .login-card {
            background: white;
            width: 360px;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .login-card h1 {
            text-align: center;
            color: #333;
            margin-bottom: 25px;
            font-size: 24px;
        }

        .form-row {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }
        input[type="text"]:focus,
        input[type="password"]:focus 
        {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0,123,255,0.5);

        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #008CBA;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #0073a6;
        }

        .note {
            text-align: center;
            font-size: 13px;
            color: #777;
            margin-top: 15px;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h1>Đăng nhập Hệ thống QLSV</h1>

        <form method="post" action="">
            <div class="form-row">
                <label>Username</label>
                <input type="text" 
                       name="username" 
                       value="<?php echo htmlspecialchars($username_value); ?>" 
                       required>
            </div>

            <div class="form-row">
                <label>Password</label>
                <input type="password" 
                       name="password" 
                       required>
            </div>

            <input type="submit" name="login" value="Đăng nhập">
        </form>

        <div class="note">
            Chỉ dành cho quản trị / nhân viên hệ thống
        </div>
    </div>

    <script>
        // 1. Hiển thị thông báo nếu có lỗi từ PHP gửi xuống
        <?php if ($error_message != ""): ?>
            alert('<?php echo $error_message; ?>');
        <?php endif; ?>

        // 2. Xử lý xóa trắng ô password khi load trang
        window.onload = function() {
            // Sử dụng setTimeout 100ms để đảm bảo chạy sau khi trình duyệt hoàn tất Auto-fill
            setTimeout(function() {
                var pwdField = document.querySelector('input[name="password"]');
                if (pwdField) {
                    pwdField.value = ''; 
                }
            }, 100);
        }
    </script>
</body>
</html>