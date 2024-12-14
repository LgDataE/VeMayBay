<?php
include '../Database/db_connection.php';
function generateCustomerCode() {
    $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $numbers = '0123456789';

    $code = '';
    for ($i = 0; $i < 4; $i++) {
        $code .= $letters[rand(0, strlen($letters) - 1)];
    }
    for ($i = 0; $i < 2; $i++) {
        $code .= $numbers[rand(0, strlen($numbers) - 1)];
    }
    return $code;
}
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $date_of_birth = $_POST['date_of_birth'];
    $gender = ($_POST['gender'] === 'male') ? 'Nam' : 'Nu';
    $nationality = $_POST['nationality'];
    if (!empty($_POST['email'])){
        $contact = $_POST['email'];
    }
    else {
        $contact =  $_POST['phone'];
    }
    $id_card = $_POST['id'];
    $cus_id = generateCustomerCode();
    // Câu lệnh SQL
    $sql = "INSERT INTO KhachHang (MaKH, HoTen, NgaySinh, GioiTinh, LienLac, QuocTich, ID)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

    $params = array($cus_id, $name, $date_of_birth, $gender, $contact, $nationality, $id_card);

    // Thực thi câu lệnh SQL
    $stmt = sqlsrv_query($conn, $sql, $params);

    if ($stmt === false) {
        echo "Lỗi: Không thể lưu thông tin khách hàng.";
    } else {
        echo "Lưu thông tin thành công!";
    }

    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
}
?>