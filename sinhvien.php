<?php
// Nhúng file config để kết nối CSDL
include 'config.php';

/* =======================
   XỬ LÝ XÓA SINH VIÊN
   ======================= */
if (isset($_GET['delete_id'])) {           // Kiểm tra có tham số delete_id trên URL hay không
    $id = $_GET['delete_id'];               // Lấy mã sinh viên cần xóa
    $sql_delete = "DELETE FROM tblSinhVien WHERE masv=$id"; // Câu lệnh SQL xóa
    mysqli_query($conn, $sql_delete);        // Thực thi câu lệnh xóa
    header("Location: sinhvien.php");        // Load lại trang sau khi xóa
}

/* =======================
   XỬ LÝ THÊM SINH VIÊN
   ======================= */
if (isset($_POST['them_moi'])) {             // Kiểm tra người dùng có bấm nút thêm mới hay không
    $hoten = $_POST['ho_ten'];               // Lấy họ tên từ form
    $ngaysinh = $_POST['ngay_sinh'];         // Lấy ngày sinh
    $gioitinh = $_POST['gioi_tinh'];         // Lấy giới tính
    $quequan = $_POST['que_quan'];           // Lấy quê quán
    $email = $_POST['email'];                // Lấy email
    $sdt = $_POST['so_dien_thoai'];          // Lấy số điện thoại
    $malop = $_POST['malop'];                // Lấy mã lớp

    // Câu lệnh SQL thêm sinh viên
    $sql_add = "INSERT INTO tblSinhVien 
        (ho_ten, ngay_sinh, gioi_tinh, que_quan, email, so_dien_thoai, malop) 
        VALUES ('$hoten', '$ngaysinh', '$gioitinh', '$quequan', '$email', '$sdt', '$malop')";

    mysqli_query($conn, $sql_add);            // Thực thi câu lệnh INSERT
    header("Location: sinhvien.php");         // Load lại trang để cập nhật danh sách
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"> <!-- Thiết lập UTF-8 để hiển thị tiếng Việt -->
    <title>Quản lý Sinh viên</title>

    <style>
        /* ===== CÀI ĐẶT CHUNG ===== */
        body {
            font-family: Arial, sans-serif;          /* Font chữ dễ nhìn */
            background-color: #f4f6f8;               /* Màu nền nhẹ */
            padding: 20px;
        }

        /* ===== NÚT TRANG CHỦ ===== */
        .Home {
            text-decoration: none;                   /* Bỏ gạch chân */
            padding: 10px 15px;
            background-color: #4CAF50;               /* Màu xanh */
            color: white;
            border-radius: 5px;
            display: inline-block;
            margin-bottom: 20px;
        }
        .Home:hover {
            background-color: #45a049;
        }

        /* ===== TIÊU ĐỀ ===== */
        .title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        /* ===== CARD FORM ===== */
        .card {
            background: white;                       /* Nền trắng */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);   /* Đổ bóng */
            margin-bottom: 30px;
        }

        /* ===== FORM ===== */
        .form-row {
            margin-bottom: 10px;
        }
        form{
            width: 100%;                             /* Chiều rộng form */
            max-width: 500px;                        /* Giới hạn chiều rộng tối đa */  
        }
        label {
            display: inline-block;
            width: 120px;                            /* Căn đều label */
            font-weight: bold;
        }

        input, select {
            padding: 6px;
            width: 200px;                    /* Chiều dài đồng nhất */
            border: 1px solid #ccc;
            border-radius: 4px;
            display: inline-block;
            margin-right: 100px;
        }

        /* ===== NÚT SUBMIT ===== */
        input[type="submit"] {
            background-color: #008CBA;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            /*căn giữa form */
            margin-left: 25%;
            width: 212px;
        }
        select{
            width: 214px !important;
        }

        /* ===== TABLE ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            background-color: #007BFF;               /* Màu header */
            color: white;
            padding: 10px;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f1f1f1;              /* Hover dòng */
        }

        /* ===== LINK HÀNH ĐỘNG ===== */
        .action a {
            margin-right: 5px;
            text-decoration: none;
            color: #007BFF;
        }

        .action a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <!-- Nút quay về trang chủ -->
    <a class="Home" href="index.php">Về trang chủ</a>

    <!-- Tiêu đề -->
    <h2 class="title">QUẢN LÝ SINH VIÊN</h2>

    <!-- ===== FORM THÊM SINH VIÊN ===== -->
    <div class="card">
        <h3>Thêm Sinh viên mới</h3>

        <form method="post">
            <div class="form-row">
                <label>Họ tên:</label>
                <input type="text" name="ho_ten" required>
            </div>

            <div class="form-row">
                <label>Ngày sinh:</label>
                <input type="date" name="ngay_sinh">
            </div>

            <div class="form-row">
                <label>Giới tính:</label>
                <select name="gioi_tinh">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>

            <div class="form-row">
                <label>Quê quán:</label>
                <input type="text" name="que_quan">
            </div>

            <div class="form-row">
                <label>Email:</label>
                <input type="email" name="email">
            </div>

            <div class="form-row">
                <label>SĐT:</label>
                <input type="text" name="so_dien_thoai">
            </div>

            <div class="form-row">
                <label>Mã lớp:</label>
                <input type="text" name="malop">
            </div>

            <input type="submit" name="them_moi" value="Lưu sinh viên">
        </form>
    </div>

    <!-- ===== BẢNG DANH SÁCH ===== -->
    <div class="card">
        <h3>Danh sách Sinh viên</h3>

        <table>
            <tr>
                <th>Mã SV</th>
                <th>Họ tên</th>
                <th>Ngày sinh</th>
                <th>Giới tính</th>
                <th>Quê quán</th>
                <th>Lớp</th>
                <th>Hành động</th>
            </tr>

            <?php
            // Lấy danh sách sinh viên
            $sql = "SELECT * FROM tblSinhVien";
            $result = mysqli_query($conn, $sql);

            // Duyệt từng sinh viên
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['masv']}</td>";
                echo "<td>{$row['ho_ten']}</td>";
                echo "<td>{$row['ngay_sinh']}</td>";
                echo "<td>{$row['gioi_tinh']}</td>";
                echo "<td>{$row['que_quan']}</td>";
                echo "<td>{$row['malop']}</td>";
                echo "<td class='action'>
                        <a href='edit_sinhvien.php?id={$row['masv']}'>Sửa</a>
                        <a href='sinhvien.php?delete_id={$row['masv']}'
                           onclick=\"return confirm('Bạn có chắc chắn muốn xóa?');\">Xóa</a>
                      </td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>

</body>
</html>
