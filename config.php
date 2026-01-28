<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "QLSV";

// tạo kết nối
$conn = mysqli_connect($servername, $username, $password, $dbname);

// kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// thiết lập bảng mã tiếng Việt
mysqli_set_charset($conn, "utf8");
?>
