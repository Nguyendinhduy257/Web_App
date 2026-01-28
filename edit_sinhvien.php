<?php
// Nhúng file config để sử dụng kết nối CSDL
include 'config.php';

/* =======================
   LẤY THÔNG TIN SINH VIÊN
   ======================= */
if (isset($_GET['id'])) {                       // Kiểm tra có tham số id trên URL hay không
    $id = $_GET['id'];                          // Lấy mã sinh viên cần sửa
    $sql = "SELECT * FROM tblSinhVien WHERE masv=$id"; // Câu lệnh SQL lấy dữ liệu
    $query = mysqli_query($conn, $sql);         // Thực thi truy vấn
    $data = mysqli_fetch_assoc($query);         // Lấy dữ liệu sinh viên dưới dạng mảng
}

/* =======================
   XỬ LÝ CẬP NHẬT
   ======================= */
if (isset($_POST['cap_nhat'])) {                // Kiểm tra nút "Cập nhật" đã được bấm chưa
    $hoten = $_POST['ho_ten'];                  // Lấy họ tên mới
    $ngaysinh = $_POST['ngay_sinh'];            // Lấy ngày sinh mới
    $gioitinh = $_POST['gioi_tinh'];            // Lấy giới tính mới
    $quequan = $_POST['que_quan'];              // Lấy quê quán mới
    $email = $_POST['email'];                   // Lấy email mới
    $sdt = $_POST['so_dien_thoai'];             // Lấy số điện thoại mới
    $malop = $_POST['malop'];                   // Lấy mã lớp mới
    $id = $_POST['masv'];                       // Lấy mã sinh viên từ input hidden

    // Câu lệnh SQL cập nhật thông tin sinh viên
    $sql_update = "UPDATE tblSinhVien SET 
        ho_ten='$hoten',
        ngay_sinh='$ngaysinh',
        gioi_tinh='$gioitinh',
        que_quan='$quequan',
        email='$email',
        so_dien_thoai='$sdt',
        malop='$malop'
        WHERE masv=$id";

    mysqli_query($conn, $sql_update);            // Thực thi câu lệnh UPDATE
    header("Location: sinhvien.php");            // Quay về trang danh sách sinh viên
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"> <!-- Thiết lập hiển thị tiếng Việt -->
    <title>Sửa Sinh viên</title>

    <style>
        /* ===== THIẾT LẬP CHUNG ===== */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            padding: 20px;
        }

        /* ===== NÚT QUAY LẠI ===== */
        .back {
            text-decoration: none;
            padding: 8px 14px;
            background-color: #6c757d;
            color: white;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 20px;
        }
        .back:hover {
            background-color: #5a6268;
        }

        /* ===== CARD ===== */
        .card {
            background: white;
            max-width: 400px;
            margin: auto;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        /* ===== TIÊU ĐỀ ===== */
        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }

        /* ===== FORM ===== */
        .form-row {
            margin-bottom: 12px;
        }

        label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
        }

        input, select {
            padding: 6px;
            width: 220px;
        }

        /* ===== NÚT SUBMIT ===== */
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 31%;
            width: 236px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
        select{
            width: 236px !important;
        }
    </style>
</head>

<body>

    <!-- Nút quay về trang danh sách -->
    <a class="back" href="sinhvien.php">← Quay lại danh sách</a>

    <!-- Card chứa form cập nhật -->
    <div class="card">
        <h2>CẬP NHẬT THÔNG TIN SINH VIÊN</h2>

        <form method="post">

            <!-- Input ẩn lưu mã sinh viên -->
            <input type="hidden" name="masv" value="<?php echo $data['masv']; ?>">

            <div class="form-row">
                <label>Họ tên:</label>
                <input type="text" name="ho_ten" value="<?php echo $data['ho_ten']; ?>" required>
            </div>

            <div class="form-row">
                <label>Ngày sinh:</label>
                <input type="date" name="ngay_sinh" value="<?php echo $data['ngay_sinh']; ?>">
            </div>

            <div class="form-row">
                <label>Giới tính:</label>
                <select name="gioi_tinh">
                    <option value="Nam" <?php if ($data['gioi_tinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                    <option value="Nữ" <?php if ($data['gioi_tinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                </select>
            </div>

            <div class="form-row">
                <label>Quê quán:</label>
                <input type="text" name="que_quan" value="<?php echo $data['que_quan']; ?>">
            </div>

            <div class="form-row">
                <label>Email:</label>
                <input type="email" name="email" value="<?php echo $data['email']; ?>">
            </div>

            <div class="form-row">
                <label>SĐT:</label>
                <input type="text" name="so_dien_thoai" value="<?php echo $data['so_dien_thoai']; ?>">
            </div>

            <div class="form-row">
                <label>Mã lớp:</label>
                <input type="text" name="malop" value="<?php echo $data['malop']; ?>">
            </div>

            <input type="submit" name="cap_nhat" value="Cập nhật sinh viên">
        </form>
    </div>

</body>
</html>
