<?php
session_start();
include '../Database/db_connection.php'; // Kết nối đến cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kiểm tra mã nhân viên từ session hoặc từ POST
    $MaNV = $_SESSION['MaNV'];

    if (!empty($MaNV)) {
        // Truy vấn lấy thông tin từ bảng NhanVien
        $sql = "SELECT HoTen, GioiTinh, SDT, DiaChi, EMAIL FROM NhanVien WHERE MaNV = ?";
        $params = array($MaNV);

        $stmt = sqlsrv_query($conn, $sql, $params);

        if ($stmt === false) {
            echo json_encode(['message' => 'Lỗi khi truy vấn cơ sở dữ liệu.']);
            exit();
        }

        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

        if ($row) {
            // Lưu dữ liệu vào session
            $_SESSION['HoTen'] = $row['HoTen'];
            $_SESSION['GioiTinh'] = $row['GioiTinh'];
            $_SESSION['SDT'] = $row['SDT'];
            $_SESSION['DiaChi'] = $row['DiaChi'];
            $_SESSION['Email'] = $row['EMAIL'];

            // Trả dữ liệu dưới dạng JSON
            echo json_encode([
                'HoTen' => $row['HoTen'],
                'GioiTinh' => $row['GioiTinh'],
                'SDT' => $row['SDT'],
                'DiaChi' => $row['DiaChi'],
                'EMAIL' => $row['EMAIL'],
            ]);
            exit();
        } else {
            echo json_encode(['message' => 'Không tìm thấy thông tin nhân viên.']);
            exit();
        }
    } else {
        echo json_encode(['message' => 'Mã nhân viên không hợp lệ.']);
        exit();
    }
}
