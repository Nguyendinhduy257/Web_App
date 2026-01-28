<?php
// Nhúng file config để sử dụng kết nối CSDL
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"> <!-- Đảm bảo hiển thị tiếng Việt -->
    <title>Tìm kiếm sinh viên</title>

    <style>
        /* ===== THIẾT LẬP CHUNG ===== */
        body {
            font-family: Arial, sans-serif;          /* Font dễ đọc */
            background-color: #f4f6f8;               /* Nền sáng */
            padding: 20px;
        }

        /* ===== NÚT TRANG CHỦ ===== */
        .home {
            text-decoration: none;
            padding: 8px 14px;
            background-color: #4CAF50;
            color: white;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 20px;
        }
        .home:hover {
            background-color: #45a049;
        }

        /* ===== TIÊU ĐỀ ===== */
        h2 {
            text-align: center;
            color: #333;
        }

        /* ===== CARD ===== */
        .card {
            background: white;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        /* ===== FORM TÌM KIẾM ===== */
        .search-box {
            text-align: center;
            margin-bottom: 0px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-box input[type="text"] {
            padding: 8px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 10px;
        }

        .search-box input[type="submit"] {
            padding: 8px 16px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .search-box input[type="submit"]:hover {
            background-color: #0069d9;
        }

        /* ===== TABLE ===== */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);

        }

        th {
            background-color: #007BFF;
            color: white;
            padding: 10px;
            text-align: left;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* ===== THÔNG BÁO ===== */
        .message {
            text-align: center;
            font-style: italic;
            margin-top: 15px;
        }
    </style>
</head>

<body>

    <!-- Nút quay về trang chủ -->
    <a class="home" href="index.php">Về trang chủ</a>

    <!-- Tiêu đề trang -->
    <h2>TÌM KIẾM SINH VIÊN</h2>

    <!-- Card chứa form tìm kiếm -->
    <div class="card">
        <form method="post" class="search-box">
            <!-- Ô nhập nội dung tìm kiếm -->
            <input type="text" name="noidung" placeholder="Nhập tên hoặc mã sinh viên">

            <!-- Nút tìm kiếm -->
            <input type="submit" name="timkiem" value="Tìm kiếm">
        </form>

        <?php
        /* =======================
           XỬ LÝ TÌM KIẾM
           ======================= */
        if (isset($_POST['timkiem'])) {              // Kiểm tra nút tìm kiếm đã được bấm chưa
            $tk = $_POST['noidung'];                 // Lấy nội dung người dùng nhập

            // Câu lệnh SQL tìm theo tên HOẶC mã sinh viên
            //LIKE với ký tự % để tìm gần đúng với nội dung nhập
            $sql = "SELECT * FROM tblSinhVien 
                    WHERE ho_ten LIKE '%$tk%' 
                       OR masv LIKE '%$tk%'";

            $result = mysqli_query($conn, $sql);     // Thực thi truy vấn

            echo "<h3>Kết quả tìm kiếm:</h3>";

            // Kiểm tra có kết quả hay không
            if (mysqli_num_rows($result) > 0) {

                // Tạo bảng hiển thị kết quả
                echo "<table>
                        <tr>
                            <th>Mã SV</th>
                            <th>Họ tên</th>
                            <th>Lớp</th>
                            <th>Quê quán</th>
                        </tr>";

                // Duyệt từng sinh viên tìm được
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>{$row['masv']}</td>";
                    echo "<td>{$row['ho_ten']}</td>";
                    echo "<td>{$row['malop']}</td>";
                    echo "<td>{$row['que_quan']}</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                // Không có sinh viên nào phù hợp
                echo "<p class='message'>Không tìm thấy sinh viên nào.</p>";
            }
        }
        ?>
    </div>

</body>
</html>
