<?php
session_start();
include '../Database/db_connection.php';

$maChuyenBay = $_SESSION['MaChuyenBay']; // Get flight code from session
$ngayKhoiHanh = $_SESSION['NgayKhoiHanh']; // Get departure date from session

$sql = "SELECT SoGhe, TinhTrang, HangGhe FROM ChoNgoiChuyenBay 
        WHERE MaChuyenBay = ? AND NgayKhoiHanh = ?";
$params = array($maChuyenBay, $ngayKhoiHanh);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(json_encode(['success' => false, 'message' => 'Lỗi truy vấn dữ liệu!']));
}

$seats = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $seats[] = [
        'SoGhe' => $row['SoGhe'],
        'TinhTrang' => $row['TinhTrang'],
        'HangGhe' => $row['HangGhe']
    ];
}

echo json_encode(['success' => true, 'seats' => $seats]);
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
