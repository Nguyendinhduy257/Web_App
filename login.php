<?php
// Bắt đầu session an toàn
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Nhúng file config để kết nối CSDL
include 'config.php';

// Khởi tạo biến
$username_value = "";
$error_message = "";

if (isset($_POST['login'])) {
    // Lấy dữ liệu từ form và loại bỏ khoảng trắng thừa
    $u = trim($_POST['username']);
    $p = trim($_POST['password']);

    $username_value = $u;


    $sql = "SELECT * FROM tblUser WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        // Gắn biến vào câu truy vấn ('ss' nghĩa là 2 biến dạng string)
        mysqli_stmt_bind_param($stmt, "ss", $u, $p);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['user'] = $u;
            
            $redirect_url = 'index.php';;
            
            echo '<script type="text/javascript">';
            echo 'window.location.href = "' . $redirect_url . '";';
            echo '</script>';
            
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=' . $redirect_url . '" />';
            echo '</noscript>';
            
            exit();
        } else {
            $error_message = "Sai tên đăng nhập hoặc mật khẩu!";
        }
        mysqli_stmt_close($stmt);
    } else {
        $error_message = "Lỗi hệ thống: Không thể kết nối cơ sở dữ liệu.";
    }
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>

    <style>
        /* ===== CÀI ĐẶT CHUNG ===== */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        /* ===== KHUNG ĐĂNG NHẬP ===== */
        .login-wrapper {
            width: 100%;
            min-height: 100vh; /* Sửa thành 100vh để chiếm toàn bộ chiều cao màn hình */
            background: linear-gradient(120deg, #74ebd5, #163ce7, #ff920d);
            background-size: 200% 200%;
            animation: gradientBG 15s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            box-sizing: border-box; /* Ngăn bị tràn khung khi có padding */
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .login-card {
            background: white;
            width: 360px;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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
            width: 100%; /* Đổi thành 100% để đồng bộ */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            box-sizing: border-box; /* Đảm bảo padding không làm phình thẻ input */
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007BFF;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
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
    <div class="login-wrapper">
        <div class="login-card">
            <h1>Đăng nhập Hệ thống QLSV</h1>

            <form method="post" action="">
                <div class="form-row">
                    <label>Username</label>
                    <input type="text" name="username" value="<?php echo htmlspecialchars($username_value); ?>" required>
                </div>

                <div class="form-row">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>

                <input type="submit" name="login" value="Đăng nhập">
            </form>

            <div class="note">
                Chỉ dành cho quản trị / nhân viên hệ thống
            </div>
        </div>
    </div>

    <script>
        <?php if ($error_message != ""): ?>
            var errorMessage = <?php echo json_encode($error_message); ?>;
            alert(errorMessage);
        <?php endif; ?>

        window.onload = function () {
            setTimeout(function () {
                var pwdField = document.querySelector('input[name="password"]');
                if (pwdField) {
                    pwdField.value = '';
                }
            }, 100);
        }
    </script>
</body>

</html>