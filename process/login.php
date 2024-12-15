<?php
session_start();
include '../Database/db_connection.php'; // Đảm bảo bạn có file này để kết nối SQL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM TKNhanVien WHERE _Username = ? AND _Password = ?";
    $params = array($username, $password); 
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    
    $stmt = sqlsrv_query($conn, $sql, $params, $options);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true)); // Hiển thị lỗi nếu truy vấn thất bại
    }

    $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

    if ($row) {
        $MaNV = $row['MaNV'];
        $_SESSION['MaNV'] = $MaNV;
        $sql2 = "SELECT ChucVu FROM NhanVien WHERE MaNV = ?";
        $params2 = array($MaNV);
        $stmt2 = sqlsrv_query($conn, $sql2, $params2);
        if ($stmt2 === false) {
            die(print_r(sqlsrv_errors(), return: true));
        }
        $roleRow = sqlsrv_fetch_array($stmt2, SQLSRV_FETCH_ASSOC);
        if ($roleRow['ChucVu'] == 1) {
            header("Location: ../HTML/Employee.php");
            exit();
        } else {
            exit();
        }
    } else {
        echo "<script>alert('Mật khẩu hoặc tài khoản không chính xác!'); window.location.href = '../HTML/Login.html';</script>";
    }
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>
