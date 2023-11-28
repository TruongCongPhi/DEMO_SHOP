<?php
include '../connections/connectdb.php';
session_start();
if ($_SESSION['admin'] == 1) {
    if (isset($_POST['tro_lai'])) {
        header('location: admin.php');
    }
    if (isset($_POST['dang_xuat'])) {
        session_unset();
        session_destroy();
        header('location: lich_su_don_hang.php');
    }

    if (isset($_SESSION['id'])) {
        $userId = $_SESSION['id'];

        // Thực hiện truy vấn SQL để lấy dữ liệu từ bảng nguoi_dung
        $selectQuery = "SELECT * FROM nguoi_dung WHERE id_nguoi_dung = $userId";
        $result = $conn->query($selectQuery);

        // Kiểm tra và gán dữ liệu vào biến $userData
        $userData = [];
        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
        }

        $dia_chi_parts = explode(',', $userData['dia_chi']);
        // Gán giá trị vào các trường tương ứng
        $tp = isset($dia_chi_parts[3]) ? trim($dia_chi_parts[3]) : '';
        $quan_huyen = isset($dia_chi_parts[2]) ? trim($dia_chi_parts[2]) : '';
        $phuong_xa = isset($dia_chi_parts[1]) ? trim($dia_chi_parts[1]) : '';
        $dia_chi_cu_the = isset($dia_chi_parts[0]) ? trim($dia_chi_parts[0]) : '';
    }
} else {
    header('location: dang_nhap.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Lấy dữ liệu từ form
    $email = $_POST['email'];
    $ten = $_POST['ten'];
    $sdt = $_POST['sdt'];
    $tp = $_POST['tp'];
    $quan_huyen = $_POST['quan_huyen'];
    $phuong_xa = $_POST['phuong_xa'];
    $dia_chi_cu_the = $_POST['dia_chi'];
    $dia_chi = "$dia_chi_cu_the,$phuong_xa,$quan_huyen,$tp";  // Đã chỉnh sửa thành dấu '/'
    $gioi_tinh = $_POST['gioi_tinh'];
    $ngay_sinh = $_POST['ngay_sinh'];

    // Chuẩn bị câu lệnh SQL UPDATE
    $updateQuery = "UPDATE nguoi_dung SET 
                    ten='$ten', 
                    email='$email', 
                    sdt='$sdt', 
                    dia_chi='$dia_chi', 
                    gioi_tinh='$gioi_tinh', 
                    ngay_sinh='$ngay_sinh' 
                    WHERE id_nguoi_dung=$userId";

    // Thực hiện câu lệnh SQL UPDATE
    if ($conn->query($updateQuery) === TRUE) {
        echo "<script>alert('Cập nhật thông tin thành công!');</script>";
    } else {
        echo "Lỗi: " . $updateQuery . "<br>" . $conn->error;
    }

    // Lấy lại dữ liệu sau khi cập nhật
    $result = $conn->query($selectQuery);
    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Tài khoản</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




    <style type="text/css">
        header {

            background-image: url(https://anhvienmimosa.com/wp-content/uploads/2020/05/chup-anh-gia-dinh-nen-mac-gi-5.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            margin-left: 110px;

        }
    </style>
</head>

<body>
    <form class="text-center p-5" method="post">
        <button class="btn btn-primary" type="submit" name="tro_lai">Trở lại </button>
        <button class="btn btn-primary" type="submit" name="dang_xuat">Đăng xuất</button>
    </form>
    <!-- start account -->
    <div class="container m-auto row g-0 bg-body-secondary position-relative">
        <div class="col-md-6 mb-md-0 p-md-4 d-flex flex-column align-items-center justify-content-center">
            <svg class="bd-placeholder-img w-100" width="100%" height="100" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Generic placeholder image" preserveAspectRatio="xMidYMid slice" focusable="false">
                <img src="https://trungtamytetanbinh.vn/Data/Sites/1/News/8161/123.jpg" class="img-fluid img-thumbnail" alt="Responsive image" style="width: 150px; height: 150px;">

            </svg>
            <p>Ảnh đại diện</p>
        </div>

        <div class="col-md-6 p-4 ">
            <h5 class="mt-0">Hồ sơ của ID_Người dùng:
                <?php echo isset($userData['id_nguoi_dung']) ? $userData['id_nguoi_dung'] : ''; ?> </h5>
            <form method="post" action="" class="row g-3">
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="inputEmail4" value="<?php echo isset($userData['email']) ? $userData['email'] : ''; ?>">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Họ tên</label>
                    <input type="text" name="ten" class="form-control" placeholder="Tên của bạn" value="<?php echo isset($userData['ten']) ? $userData['ten'] : ''; ?>">
                </div>
                <div class="col-6">
                    <label for="sdt" class="form-label">Số điện thoại</label>
                    <input type="text" name="sdt" class="form-control" id="sdt" placeholder="Số điện thoại của bạn" value="<?php echo isset($userData['sdt']) ? $userData['sdt'] : ''; ?>">
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-4">
                    <label for="inputCity" class="form-label">Thành phố/Tỉnh</label>
                    <input type="text" name="tp" class="form-control" id="inputCity" value="<?= $tp ?>">
                </div>
                <div class="col-md-4">
                    <label for="" class="form-label">Quận/huyện</label>
                    <input type="text" name="quan_huyen" class="form-control" id="" value="<?= $quan_huyen ?>">
                </div>
                <div class="col-md-4">
                    <label for="" class="form-label">Phường/xã</label>
                    <input type="text" name="phuong_xa" class="form-control" id="" value="<?= $phuong_xa ?>">
                </div>
                <div class="col-12">
                    <label class="form-label">Địa chỉ cụ thể</label>
                    <input type="text" name="dia_chi" class="form-control" id="inputAddress" value="<?= $dia_chi_cu_the ?>" placeholder="ngõ / ngách / nhà số">
                </div>
                <div class="col-md-4">
                    <label for="inputState" class="form-label">Giới tính</label>
                    <select name="gioi_tinh" id="inputState" class="form-select">
                        <option <?php echo (isset($userData['gioi_tinh']) && $userData['gioi_tinh'] === 'Nam') ? 'selected' : ''; ?>>
                            Nam</option>
                        <option <?php echo (isset($userData['gioi_tinh']) && $userData['gioi_tinh'] === 'Nữ') ? 'selected' : ''; ?>>
                            Nữ</option>
                        <option <?php echo (isset($userData['gioi_tinh']) && $userData['gioi_tinh'] === 'Khác') ? 'selected' : ''; ?>>
                            Khác</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="" class="form-label">Ngày sinh</label>
                    <input type="date" name="ngay_sinh" class="form-control" id="inputZip" value="<?php echo isset($userData['ngay_sinh']) ? $userData['ngay_sinh'] : ''; ?>">
                </div>
                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>


</body>


</html>