<?php include 'connections/connectdb.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đơn hàng</title>
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
    <?php
    include 'includes/navbar.php';
    include 'giohang.php'; ?>
    <div class="container-fluid " style=" margin-top:100px"">

    <div class=" container">
        <!-- Title -->
        <div class="d-flex justify-content-between align-items-center py-3">
            <h2 class="h5 mb-0"><a href="#" class="text-muted"></a>Mã đơn hàng #16123222</h2>
        </div>

        <!-- Main content -->
        <div class="row">
            <div class="col-lg-8">
                <!-- Details -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="mb-3 d-flex justify-content-between">
                            <div>
                                <span class="me-3">22-11-2021</span>
                                <span class="me-3">id: #123</span>

                                <span class="badge rounded-pill bg-info">Đặt hàng</span>
                            </div>

                        </div>
                        <table class="table table-borderless">
                            <tbody>
                                <?php
                                // Lấy dữ liệu từ bảng gio_hang và san_pham

                                if (isset($_GET['id_gio_hang'])) {
                                    $id_gio_hang = $_GET['id_gio_hang'];
                                    $userId = $_SESSION['id'];

                                    $sql = "SELECT gio_hang.id_gio_hang,gio_hang.so_luong, san_pham.ten_san_pham, san_pham.gia,gio_hang.mau_sac,gio_hang.kich_thuoc, san_pham.hinh_anh, gio_hang.thoi_gian
                                        FROM gio_hang
                                        INNER JOIN san_pham ON gio_hang.id_san_pham = san_pham.id_san_pham 
                                        WHERE gio_hang.id_nguoi_dung = $userId";
                                    $result = $conn->query($sql);

                                    $tong_tien = 0;

                                    if ($result->num_rows > 0) {
                                        $count = 1;
                                        // Hiển thị sản phẩm từ giỏ hàng
                                        while ($row = $result->fetch_assoc()) {
                                            $id_gio_hang = $row['id_gio_hang'];
                                            $mau_sac = $row['mau_sac'];
                                            $sql = "SELECT * FROM mau_sac"; // Sắp xếp theo giá tăng dần
                                            $result2 = $conn->query($sql);
                                            if ($row2 = mysqli_fetch_assoc($result2)) {
                                                $ten_mau_sac = $row2['ten_mau_sac'];
                                            }
                                            $so_luong = $row['so_luong'];
                                            $tong_sp = $so_luong * $row['gia'];
                                            $tong_tien += $tong_sp;
                                            $gia = number_format($row['gia'], 0, '.', '.');

                                ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex mb-2">
                                                        <div class="flex-shrink-0">
                                                            <img src="uploads/<?= $row['hinh_anh'] ?>" alt="" width="35" class="img-fluid">
                                                        </div>
                                                        <div class="flex-lg-grow-1 ms-3">
                                                            <h6 class="small mb-0"><a href="#" class="text-reset"><?= $row['ten_san_pham'] ?></a></h6>
                                                            <span class="small">Màu: <?= $ten_mau_sac ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><?= $so_luong ?></td>
                                                <td class="text-end"><?= number_format($tong_sp, 0, '.', '.') ?></td>
                                            </tr>
                                <?php }
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2">
                                        <h5>Tổng sản phẩm</h5>
                                    </td>
                                    <td class="text-end h5"><?= number_format($tong_tien, 0, '.', '.') ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">Phí vận chuyển</td>
                                    <td class="text-end">20.000d</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Mã giảm giá (Mã: NEWYEAR)</td>
                                    <td class="text-danger text-end">- 40.000đ</td>
                                </tr>
                                <tr class="fw-bold">
                                    <td colspan="2">
                                        <h4>Tổng</h4>
                                    </td>
                                    <td class="h4 text-end"><?= number_format($tong_tien - 60000, 0, '.', '.') ?></td>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
                </div>
                <!-- Payment -->
                <div class="card my-5 border-0">

                </div>
                <div class="card my-5" style="margin-bottom: 50px;">
                    <div class="card-body text-center">
                        <a href="thanh_toan.php?id_gio_hang=<?= $id_gio_hang ?>" type="button" class="btn btn-warning btn-block btn-lg">Thanh
                            toán</a>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <!-- Customer Notes -->
                <div class="card mb-4">
                    <div class="input-group">
                        <span class="input-group-text">Ghi chú</span>
                        <textarea class="form-control" aria-label="With textarea"></textarea>
                    </div>
                </div>
                <div class="card mb-4">
                    <?php if (isset($_SESSION['id'])) {
                        $userId = $_SESSION['id'];

                        // Thực hiện truy vấn SQL để lấy dữ liệu từ bảng nguoi_dung
                        $selectQuery = "SELECT * FROM nguoi_dung WHERE id_nguoi_dung = $userId";
                        $result = $conn->query($selectQuery);

                        // Kiểm tra và gán dữ liệu vào biến $userData
                        $userData = [];
                        if ($result->num_rows > 0) {
                            $userData = $result->fetch_assoc();
                        }

                        $dia_chi_parts = explode('/', $userData['dia_chi']);
                    }
                    ?>
                    <!-- Shipping information -->
                    <div class="card-body">
                        <h3 class="h6">Thông tin vận chuyển</h3>
                        <strong>Thông tin</strong>
                        <span>đang cập nhật</span>
                        <hr>
                        <h3 class="h6">Địa chỉ nhận hàng</h3>
                        <address>
                            <strong>...</strong><br>
                            <?= $userData['dia_chi'] ?>
                            <br>
                            <abbr title="Phone">SDT:</abbr> 0<?= $userData['sdt'] ?>
                        </address>
                        <p class="text-danger">Nếu sai vui lòng chỉnh sửa trong tài khoản của mình <a href="tai_khoan.php">Tại đây</a> </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php include 'includes/footer.php'; ?>
</body>

</html>