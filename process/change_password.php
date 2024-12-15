<?php
session_start();
include '../Database/db_connection.php'; // Kết nối cơ sở dữ liệu

// Lấy dữ liệu JSON từ fetch API
$input = file_get_contents("php://input");
$data = json_decode($input, true);
if (!$conn) {
    die("Kết nối cơ sở dữ liệu thất bại: " . print_r(sqlsrv_errors(), true));
}

// Lấy thông tin từ yêu cầu
$currentPassword = $data['currentPassword'];
$newPassword = $data['newPassword'];
$maNV = isset($_SESSION['MaNV']) ? $_SESSION['MaNV'] : null; // Lấy mã nhân viên từ session

// Kiểm tra mã nhân viên
if (empty($maNV)) {
    echo json_encode(['success' => false, 'message' => 'Mã nhân viên không hợp lệ.']);
    exit();
}

// Kiểm tra mật khẩu hiện tại
$sql = "SELECT _Password FROM TKNhanVien WHERE MaNV = ?";
$params = array($maNV);
$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    die(json_encode(['success' => false, 'message' => 'Truy vấn SELECT lỗi: ' . print_r(sqlsrv_errors(), true)]));
}

$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

if (!$row || $row['_Password'] !== $currentPassword) {
    die(json_encode(['success' => false, 'message' => 'Mật khẩu hiện tại không đúng hoặc không tìm thấy.']));
}


// Cập nhật mật khẩu mới
$sqlUpdate = "UPDATE TKNhanVien SET _Password = ? WHERE MaNV = ?";
$paramsUpdate = array($newPassword, $maNV); // Gửi trực tiếp mật khẩu mới
$stmtUpdate = sqlsrv_query($conn, $sqlUpdate, $paramsUpdate);

if ($stmtUpdate === false) {
    echo json_encode(['success' => false, 'message' => 'Lỗi khi cập nhật mật khẩu.']);
    exit();
}

// Trả phản hồi thành công
echo json_encode(['success' => true, 'message' => 'Mật khẩu đã được cập nhật thành công!']);
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);    
?>
