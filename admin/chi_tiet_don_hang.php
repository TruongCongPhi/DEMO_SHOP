<?php
include '../connections/connectdb.php';
session_start();
if ($_SESSION['admin'] == 1) {
    if (isset($_POST['tro_lai'])) {
        header('location: lich_su_don_hang.php');
    }
    if (isset($_POST['dang_xuat'])) {
        session_unset();
        session_destroy();
        header('location: dang_nhap.php');
    }
} else {
    header('location: dang_nhap.php');
    exit();
}

// Lấy dữ liệu từ bảng gio_hang và san_pham
$id_don_hang = isset($_GET['id_don_hang']) ? $_GET['id_don_hang'] : null;

$tong_tien = 0;
$sql_don_hang = "SELECT * FROM don_hang WHERE id_don_hang = $id_don_hang";
$result_don_hang = $conn->query($sql_don_hang);

// Kiểm tra và hiển thị thông tin chi tiết đơn hàng
$details = $result_don_hang->num_rows > 0;
if ($details) {
    while ($row_don_hang = $result_don_hang->fetch_assoc()) {
        $tong_tien = $row_don_hang['tong_tien'];
    }
}

// Truy vấn SQL để lấy chi tiết đơn hàng
$sql_chi_tiet_don_hang = "SELECT * FROM chi_tiet_don_hang WHERE id_don_hang = $id_don_hang";
$result_chi_tiet_don_hang = $conn->query($sql_chi_tiet_don_hang);

// Kiểm tra và hiển thị thông tin chi tiết đơn hàng
$details_found = $result_chi_tiet_don_hang->num_rows > 0;


// Thông tin vận chuyển
$userData = [];
$dia_chi_parts = '';

if (isset($_GET['id_nguoi_dung'])) {
    $userId = $_GET['id_nguoi_dung'];

    // Thực hiện truy vấn SQL để lấy dữ liệu từ bảng nguoi_dung
    $selectQuery = "SELECT * FROM nguoi_dung WHERE id_nguoi_dung = $userId";
    $result = $conn->query($selectQuery);

    // Kiểm tra và gán dữ liệu vào biến $userData
    if ($result->num_rows > 0) {
        $userData = $result->fetch_assoc();
    }

    $dia_chi_parts =  $userData['dia_chi'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chi Tiết Đơn hàng</title>
    <style type="text/css">
        body {
            background: #eee;
        }

        .card {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 0 solid rgba(0, 0, 0, .125);
            border-radius: 1rem;
        }

        .text-reset {
            --bs-text-opacity: 1;
            color: inherit !important;
        }

        a {
            color: #5465ff;
            text-decoration: none;
        }
    </style>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <form class="text-center p-5" method="post">
        <button class="btn btn-primary" type="submit" name="tro_lai">Trở lại </button>
        <button class="btn btn-primary" type="submit" name="dang_xuat">Đăng xuất</button>
    </form>
    <div class="container-fluid">

        <div class="container">

            <!-- Main content -->
            <div class="row">

                <!-- Details -->
                <div class="card mb-4">
                    <div class="card-body">


                        <table class="table table-borderless">
                            <tbody>
                                <!-- Chi tiết đơn hàng -->
                                <?php if ($details_found) { ?>
                                    <div class="card my-5 border-0">
                                        <div class="card-body">
                                            <h3 class="h6">Chi tiết đơn hàng</h3>
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID Sản phẩm</th>
                                                        <th scope="col">Màu sắc</th>
                                                        <th scope="col">Kích thước</th>
                                                        <th scope="col">Số lượng</th>
                                                        <th scope="col">Giá</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    // Hiển thị thông tin chi tiết đơn hàng ở đây
                                                    while ($row_chi_tiet_don_hang = $result_chi_tiet_don_hang->fetch_assoc()) {
                                                        echo '<tr>';
                                                        // Thêm các cột thông tin chi tiết đơn hàng
                                                        echo '<td>' . $row_chi_tiet_don_hang['id_san_pham'] . '</td>';
                                                        echo '<td>' . $row_chi_tiet_don_hang['mau_sac'] . '</td>';
                                                        echo '<td>' . $row_chi_tiet_don_hang['kich_thuoc'] . '</td>';
                                                        echo '<td>' . $row_chi_tiet_don_hang['so_luong'] . '</td>';
                                                        echo '<td>' . $row_chi_tiet_don_hang['gia'] . '</td>';
                                                        echo '</tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <?php } else {
                                    echo "No details found for this order.";
                                }
                                ?>
                                <!-- ... (các đoạn mã khác không thay đổi) ... -->
                            </tbody>

                        </table>

                    </div>


                </div>
                <div class="card mb-4 mx-5">
                    <div class="card-body">
                        <h3 class="h6">Tổng</h3>
                        <td class="h4 text-end"><?= number_format($tong_tien - 60000, 0, '.', '.') ?>
                    </div>
                </div>
                <div class="card mb-4 mx-5">
                    <div class="card-body">
                        <h3 class="h6">Thông tin vận chuyển</h3>
                        <?= $dia_chi_parts ?>
                    </div>
                </div>



            </div>
        </div>
    </div>


</body>

</html>