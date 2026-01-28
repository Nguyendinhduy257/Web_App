<?php
/* --- 1. KIỂM TRA QUYỀN TRUY CẬP (SESSION) --- 
   Đảm bảo chỉ người dùng đã đăng nhập mới có thể vào trang này.
*/
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ - Hệ thống QLSV</title>
    
    <style>
        /* --- 2. GIAO DIỆN (CSS) --- 
           Định dạng phong cách cho Menu, Tiêu đề và Khung nội dung.
        */
        body { 
            font-family: 'Segoe UI', Arial, sans-serif; 
            margin: 0; 
            background-color: #f0f2f5; 
        }
        .menu { 
            background: #2c3e50; 
            padding: 15px 50px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .menu-links a { 
            color: #ecf0f1; 
            text-decoration: none; 
            margin-left: 20px; 
            font-weight: 600;
            transition: 0.3s;
        }
        .menu-links a:hover { 
            color: #3498db; 
        }
        .container { 
            max-width: 1000px; 
            margin: 50px auto; 
            padding: 40px; 
            background: white; 
            border-radius: 12px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            text-align: center; 
        }
        h1 { color: #2c3e50; margin-bottom: 20px; }
        p { color: #7f8c8d; font-size: 1.1em; }
    </style>
</head>
<body>

    <div class="menu">
        <div class="user-info">
            Xin chào: <strong><?php echo $_SESSION['user']; ?></strong>
        </div>
        <div class="menu-links">
            <a href="index.php">Trang chủ</a>
            <a href="sinhvien.php">Quản lý Sinh viên</a>
            <a href="#">Quản lý Người dùng</a> 
            <a href="#">Quản lý Khoa</a>
            <a href="#">Quản lý Lớp</a>
            <a href="timkiem.php">Tìm kiếm</a>
            <a href="login.php" style="color: #e74c3c;">Đăng xuất</a>
        </div>
    </div>

    <div class="container">
        <h1>HỆ THỐNG QUẢN LÝ SINH VIÊN</h1>
        <p>Chào mừng bạn quay trở lại với hệ thống quản trị nội bộ.</p>
        <p>Sử dụng thanh menu phía trên để bắt đầu thao tác với dữ liệu.</p>
    </div>

</body>
</html>