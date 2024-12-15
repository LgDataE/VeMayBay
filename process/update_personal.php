<?php
session_start();
include '../Database/db_connection.php'; // Kết nối tới cơ sở dữ liệu

// Nhận dữ liệu từ fetch API
$input = file_get_contents("php://input");
$data = json_decode($input, true);

// Kiểm tra dữ liệu nhận được
$maNV = $_SESSION['MaNV']; // Lấy mã nhân viên từ session
$hoTen = $data['employeeName'];
$gioiTinh = $data['employeeGender'];
$email = $data['employeeEmail'];
$sdt = $data['employeePhoneNumber'];
$diaChi = $data['employeeAddress'];

// Kiểm tra dữ liệu hợp lệ
if (empty($maNV) || empty($hoTen) || empty($gioiTinh) || empty($email) || empty($sdt) || empty($diaChi)) {
    echo json_encode(['success' => false, 'message' => 'Dữ liệu không hợp lệ!']);
    exit();
}

// Câu lệnh UPDATE
$sql = "UPDATE NhanVien SET HoTen = ?, GioiTinh = ?, EMAIL = ?, SDT = ?, DiaChi = ? WHERE MaNV = ?";
$params = array($hoTen, $gioiTinh, $email, $sdt, $diaChi, $maNV);

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt === false) {
    echo json_encode(['success' => false, 'message' => 'Lỗi khi cập nhật thông tin.']);
    exit();
}

// Cập nhật lại session
$_SESSION['HoTen'] = $hoTen;
$_SESSION['GioiTinh'] = $gioiTinh;
$_SESSION['Email'] = $email;
$_SESSION['SDT'] = $sdt;
$_SESSION['DiaChi'] = $diaChi;

// Trả về phản hồi JSON
echo json_encode(['success' => true, 'message' => 'Cập nhật thành công!']);

sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);
?>
