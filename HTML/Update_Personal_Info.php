<?php
session_start();
if (!isset($_SESSION['HoTen'])) {
    echo "<script>alert('Dữ liệu nhân viên không tồn tại.'); window.location.href = '../HTML/Employee.html';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Personal Information</title>
    <link rel="stylesheet" href="../CSS/admin1.css">
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
                    <img src="/assets/image/Logo.png" alt="" style="height: 50px;">
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
    <div class="manage-container ">
        <!--Update Personal Info Form-->
        <div class="form-section">
            <div class="form-container flex-column justify-content-center align-items-center ps-5 pt-5">
        
                <div class="form-title-container">
                    <h4>Đổi thông tin cá nhân</h4>
                </div>

                <form action="" method="post" class="main-form d-flex flex-column">

                    <div class="form-uneditable-group d-flex justify-content-between">
                        <div class="input-container">
                            <label for="employee-name">Họ và tên:</label>
                            <input type="text" id="employee-name" name="employee-name" value="<?php echo htmlspecialchars($_SESSION['HoTen']); ?>" disabled size="20" maxlength="50">
                        </div>
                        
                        <div class="input-container">
                            <label for="employee-gender">Giới tính:</label>
                            <input type="text" id="employee-gender" class="me-0" name="employee-gender" value="<?php echo htmlspecialchars($_SESSION['GioiTinh']); ?>"disabled size="3" maxlength="5">
                        </div>
                    </div>
                    <br>

                    <div class="form-editable-group d-flex justify-content-between">
                        <div class="input-container">
                            <label for="employee-email">Email:</label>
                            <input type="email" id="employee-email" name="employee-email" value="<?php echo htmlspecialchars($_SESSION['Email']); ?>" readonly maxlength="50" size="40">

                            <button type="button" class="btn btn-secondary btn-sm" onclick="editInput('employee-email')">Sửa</button>
                        </div>
                    </div>
                    <br>
                    
                    <div class="form-editable-group d-flex justify-content-between">
                        <div class="input-container">
                            <label for="employee-phone-number">Số điện thoại:</label>
                            <input type="text" id="employee-phone-number" name="employee-phone-number" value="<?php echo htmlspecialchars($_SESSION['SDT']); ?>"readonly maxlength="10" size="40" onkeypress="return isNumberKey(event)">
                            
                            <button type="button" class="btn btn-secondary btn-sm" onclick="editInput('employee-phone-number')">Sửa</button>
                        </div>

                    </div>
                    <br>
                    <div class="form-editable-group d-flex justify-content-between">
                        <div class="input-container">
                            <label for="employee-address">Địa chỉ:</label>
                            <input type="text" id="employee-address" name="Address" value="<?php echo htmlspecialchars($_SESSION['DiaChi']); ?>" readonly size="40" maxlength="200">

                            <!-- Button for change address modal -->
                            <button type="button" class="btn btn-secondary btn-sm" onclick="editInput('employee-address')">Sửa</button>
                        </div>
                    </div>
                    <br><br>

                    <div class="form-editable-group justify-content-end">
                        <!-- Button for change password modal -->
                        <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Đổi mật khẩu</button>

                        <!-- Submit button -->
                        <button type="button" class="btn btn-primary submit-button" onclick="saveChanges()">Lưu thay đổi</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change password modal -->
        <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="changePasswordModalLabel">Đổi mật khẩu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form đổi mật khẩu -->
                        <form>
                            <div class="mb-3">
                                <label for="currentPassword" class="form-label">Mật khẩu hiện tại</label>
                                <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Mật khẩu mới</label>
                                <input type="password" class="form-control" id="newPassword"  name="newPassword" required>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Xác nhận mật khẩu mới</label>
                                <input type="password" class="form-control" id="v"  name="confirmPassword" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary" onclick="changePassword(events)">Lưu thay đổi</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
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

        function editInput(inputId) {
            const input = document.getElementById(inputId);
            if (input.hasAttribute("readonly")) {
                input.removeAttribute("readonly"); // Bỏ thuộc tính readonly để cho phép sửa
                input.focus(); // Đưa con trỏ chuột vào ô input
            } else {
                input.setAttribute("readonly", ""); // Khóa lại ô input
            }
        }

        function saveChanges() {
            // Lấy tất cả các ô input
            const inputs = document.querySelectorAll("input");
            inputs.forEach(input => {
                // Thêm lại thuộc tính readonly cho tất cả các ô input
                input.setAttribute("readonly", "");
            });
            alert("Thay đổi đã được lưu và các ô đã được khóa lại.");
        }

        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            // Chỉ cho phép nhập các ký tự số (0-9)
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }
        function saveChanges() {
                // Lấy dữ liệu từ các ô input
                const employeeData = {
                    maNV: "<?php echo $_SESSION['MaNV']; ?>",
                    employeeName: document.getElementById('employee-name').value,
                    employeeGender: document.getElementById('employee-gender').value,
                    employeeEmail: document.getElementById('employee-email').value,
                    employeePhoneNumber: document.getElementById('employee-phone-number').value,
                    employeeAddress: document.getElementById('employee-address').value
                };

                // Gửi dữ liệu bằng fetch API
                fetch('../process/update_personal.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json' // Gửi dữ liệu JSON
                    },
                    body: JSON.stringify(employeeData) // Convert dữ liệu sang JSON
                })
                    .then(response => response.json()) // Parse JSON từ server
                    .then(data => {
                        if (data.success) {
                            // Hiển thị thông báo thành công
                            alert('Cập nhật thông tin thành công!');
                            // Nếu cần, bạn có thể cập nhật giao diện hoặc giá trị các ô input
                        } 
                    })
            }
            function changePassword(event) {
                event.preventDefault();
    // Lấy dữ liệu từ form dựa trên thuộc tính `name`
    const currentPassword = document.querySelector("input[name='currentPassword']").value;
    const newPassword = document.querySelector("input[name='newPassword']").value;
    const confirmPassword = document.querySelector("input[name='confirmPassword']").value;

    // Kiểm tra mật khẩu mới và xác nhận mật khẩu
    if (newPassword !== confirmPassword) {
        alert("Mật khẩu mới và xác nhận mật khẩu không khớp.");
        return;
    }

    // Tạo object dữ liệu gửi đi
    const passwordData = {
        currentPassword: currentPassword,
        newPassword: newPassword,
        maNV: "<?php echo $_SESSION['MaNV']; ?>" // Lấy mã nhân viên từ session PHP
    };

    // Gửi dữ liệu bằng fetch API
    fetch("../process/change_password.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json" // Định dạng dữ liệu gửi đi
        },
        body: JSON.stringify(passwordData) // Chuyển object thành JSON
    })
        .then(response => response.json()) // Parse JSON từ server
        .then(data => {
            if (data.success) {
                alert(data.message); // Hiển thị thông báo thành công
                // Reset form sau khi đổi mật khẩu thành công
                document.querySelector("form").reset();
            } else {
                alert(data.message); // Hiển thị thông báo lỗi
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
