<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý</title>
    <link rel="stylesheet" href="../CSS/admin.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="navbar">
            <img src="../assets/image/Logo.png" alt="" style="height: 100px;">
        </div>
    </header>
        <div class="manage-container">
         <!-- Sidebar -->
            <div class="admin-sidebar">
                <h2>Nhân Viên</h2>
                <ul>
                    <li><a href="../HTML/Update_Personal_Info.php">Đổi thông tin cá nhân</a></li>
                    <li>
                        <a href="#">Quản lý thông tin vé</a>
                        <div class="drop-down">
                            <a href="../HTML/Book_Flight.html">Tạo</a>
                            <a href="">Xóa</a>
                            <a href="">Cập nhật</a>
                            <a href="">Xem</a>
                        </div>
                    </li>
                    <li><a href="Book_Flight.html">Tìm chuyến bay</a></li>
                    <li><a href="Customer.html">Lưu thông tin khách hàng</a></li>
                    <li><a href="#">Quản lý thông tin khách hàng</a></li>
                    <li><a href="#">Thanh toán</a></li>
                    <li><a href="#">Quản lý hóa đơn</a></li>
                </ul>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                // Tạo đối tượng FormData để gửi mã nhân viên
                const formData = new FormData();
                formData.append('MaNV', "<?php echo isset($_SESSION['MaNV']) ? $_SESSION['MaNV'] : ''; ?>");
        
                // Gửi yêu cầu đến select_personal.php
                fetch('../process/select_personal.php', {
                    method: 'POST',
                    body: formData,
                })
                    .then((response) => response.json()) // Chuyển đổi phản hồi thành JSON
            });
        </script>
        
            
</body>
</html>
