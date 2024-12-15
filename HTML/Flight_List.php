<?php
session_start();
$flights = isset($_SESSION['flights']) ? $_SESSION['flights'] : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Personal Information</title>
    <link rel="stylesheet" href="../CSS/flight_list.css">
    <link rel="stylesheet" href="../CSS/sidebar.css">
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../Bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Header -->
    <header>
        <nav>
            <div class="logo">
                <i class="bx bx-menu bx-md menu-icon"></i>
                <img src="../assets/image/Logo.png" alt="" style="height: 50px;">
                <span class="logo-name">HighFlight</span>
            </div>
            <div class="sidebar">
                <div class="logo">
                    <i class="bx bx-menu bx-md menu-icon"></i>
                    <img src="../assets/image/Logo.png" alt="" style="height: 50px;">
                    <span class="logo-name">HighFlight</span>
                </div>
                <div class="sidebar-name">
                    <h5>Nhân Viên</h5>
                </div>
                <div class="sidebar-content">
                    <ul class="lists">
                        <li class="list">
                            <a href="Update_Personal_Info.html" class="sidebar-link">
                                <i class='bx bxs-info-circle'></i>
                                <span class="link">Đổi thông tin cá nhân</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="#" class="sidebar-link">
                                <i class='bx bxs-coupon'></i>
                                <span class="link">Quản lý thông tin vé</span>
                            </a>
                            <ul class="drop-down">
                                <li><a href="">Tạo</a></li>
                                <li><a href="">Xoá</a></li>
                                <li><a href="">Cập nhật</a></li>
                                <li><a href="">Xem</a></li>
                            </ul>
                        </li>
                        <li class="list">
                            <a href="#" class="sidebar-link">
                                <i class='bx bxs-file-find'></i>
                                <span class="link">Tìm chuyến bay</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="#" class="sidebar-link">
                                <i class='bx bxs-user-detail' ></i>
                                <span class="link">Quản lý thông tin khách hàng</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="#" class="sidebar-link">
                                <i class='bx bxs-credit-card-front' ></i>
                                <span class="link">Thanh toán</span>
                            </a>
                        </li>
                        <li class="list">
                            <a href="#" class="sidebar-link">
                                <i class='bx bxs-note'></i>
                                <span class="link">Quản lý hoá đơn</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <script>
        function getCurrentInformation() {
            const email = document.getElementById('employee-email').value;
            const phonenumber =  document.getElementById('employee-phone-number').value;
            const address = document.getElementById('employee-address').value;

            document.getElementById('currentEmail').value = email;
            document.getElementById('currentPhoneNumber').value = phonenumber;
            document.getElementById('currentAddress').value = address;
        }
    </script>

    <script>
        const navBar = document.querySelector("nav"),
            menuBtns = document.querySelectorAll(".menu-icon"),
            overlay = document.querySelector(".overlay");

        menuBtns.forEach((menuBtn) => {
            menuBtn.addEventListener("click", () => {
                navBar.classList.toggle("open");
            });
        });

        overlay.addEventListener("click", () => {
            navBar.classList.remove("open");
        });
    </script>

        <!-- FORM -->
            <div class="container">
                <h2>Thông Tin Vé Máy Bay</h2>
                <?php if (!empty($flights)): ?>
        <ul class="list-view">
            <?php foreach ($flights as $flight): ?>
                <li class="list-view-item">
                    <div class="list-content">
                        <div class="flight_header">
                            <h1 class="list-title"><?= htmlspecialchars($flight['MaChuyenBay']) ?></h1>
                            <p class="list-description">From: <?= htmlspecialchars($flight['DiaDiemKhoiHanh']) ?></p>
                            <p class="list-description">To: <?= htmlspecialchars($flight['DiaDiemDen']) ?></p>
                        </div>
                        <div class="flight_time">
                             <p class="list-description date1">Ngày bay: <?= htmlspecialchars($flight['NgayKhoiHanh']->format('d/m/Y')) ?></p>
                            <p class="list-description flight_time"><?= htmlspecialchars($flight['GioKhoiHanh']->format('H:i')) ?></p>
                            <p style="font-size: 15px; margin-top:5px; margin-right:10px; margin-bottom: 0">đến</p>
                            <p class="list-description"><?= htmlspecialchars($flight['GioDen']->format('H:i')) ?></p>
                        </div>
                       
                    </div>
                    <div class="list-action">
                    <button onclick="saveSessionAndRedirect('<?= htmlspecialchars($flight['MaChuyenBay']) ?>', '<?= htmlspecialchars($flight['NgayKhoiHanh']->format('Y-m-d')) ?>')">
                Đặt chỗ ngồi
            </button>
                    </div>
                </li>
            <?php endforeach; ?>
            <?php else: ?>
        <p>Không có chuyến bay nào khớp với tìm kiếm của bạn.</p>
    <?php endif; ?>
        </ul>
            </div>
        </div>
        <script>
    function saveSessionAndRedirect(maChuyenBay, ngayKhoiHanh) {
        // Tạo một object chứa dữ liệu
        const flightData = {
            MaChuyenBay: maChuyenBay,
            NgayKhoiHanh: ngayKhoiHanh
        };

        // Gửi dữ liệu bằng fetch API
        fetch('../process/select_seat.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(flightData)
        })
        .then(response => response.json()) // Nhận phản hồi JSON
        .then(data => {
            if (data.success) {
                // Chuyển hướng tới Book_Ticket.html nếu thành công
                window.location.href = '../HTML/Book_Ticket.html';
            } else {
                alert("Lỗi: " + data.message);
            }
        })
        .catch(error => {
            console.error("Lỗi:", error);
            alert("Đã xảy ra lỗi, vui lòng thử lại.");
        });
    }
</script>

</body>
</html>