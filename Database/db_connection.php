<?php
$serverName = "DESKTOP-LOVB477"; // Hoặc địa chỉ IP máy chủ SQL Server
$connectionOptions = array(
    "Database" => "DaiLyVeMayBay", // Tên cơ sở dữ liệu
    "Uid" => "sa", // Tên đăng nhập SQL Server
    "PWD" =>  "123",// Mật khẩu
    "CharacterSet" => "UTF-8" // Đảm bảo hỗ trợ tiếng Việt
);

// Kết nối đến SQL Server
$conn = sqlsrv_connect($serverName, $connectionOptions);

// Kiểm tra kết nối
if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}
?>