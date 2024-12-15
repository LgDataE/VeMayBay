<?php
include '../Database/db_connection.php'; // Kết nối tới cơ sở dữ liệu

// Nhận dữ liệu từ form
$departure = $_POST['departure'];
$destination = $_POST['destination'];
$departure_date = $_POST['departure_date'];
$return_date = $_POST['return_date'];
$round_trip = $_POST['roundTrip'];

// Sửa câu lệnh SQL để khớp với tên cột trong cơ sở dữ liệu
$sql = "SELECT * FROM ChuyenBay 
        WHERE DiaDiemKhoiHanh = ? 
          AND DiaDiemDen = ? 
          AND NgayKhoiHanh = ?";
$params = array($departure, $destination, $departure_date);

// Thực hiện truy vấn
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true)); // Hiển thị lỗi nếu có
}

// Lưu kết quả vào mảng
$flights = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $flights[] = $row;
}

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

// Chuyển kết quả qua Flight_List.html
session_start();
$_SESSION['flights'] = $flights;
header("Location: ../HTML/Flight_List.php");
exit();
?>
