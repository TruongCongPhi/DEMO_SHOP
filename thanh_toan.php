<?php include 'connections/connectdb.php';
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thanh Toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="payment.css">
</head>

<body>
    <!-- Navigation-->
    <?php
    include 'includes/navbar.php';
    include 'giohang.php';
    if (isset($_GET['id_gio_hang'])) {
        $id_gio_hang = $_GET['id_gio_hang'];
        $userId = $_SESSION['id'];

        // Fetch products related to the given id_gio_hang from the database
        $sql = "SELECT gio_hang.id_gio_hang, gio_hang.so_luong, san_pham.ten_san_pham, san_pham.gia, san_pham.hinh_anh
                          FROM gio_hang
                          INNER JOIN san_pham ON gio_hang.id_san_pham = san_pham.id_san_pham 
                          WHERE gio_hang.id_nguoi_dung = $userId";

        $result = $conn->query($sql);

        // Display the products in the order
        $tong = 0;
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $so_luong = $row['so_luong'];
                $tong_gia_sp = $so_luong * $row['gia'];
                $tong += $tong_gia_sp;
            }
        }
    }

    ?>
    <form method="post" action="">
        <div style="margin-bottom: 500px; margin-top:200px" class="container">
            <h1 class="h3 mt-5 mb-5">THANH TOÁN</h1>
            <div class="row">
                <!-- Left -->
                <div class="col-lg-9">
                    <div class="accordion" id="accordionPayment">
                        <!-- Credit card -->
                        <div class="accordion-item mb-3">
                            <h2 class="h5 px-4 py-3 accordion-header d-flex justify-content-between align-items-center">
                                <div class="form-check w-100 collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapseCC" aria-expanded="false">
                                    <input class="form-check-input" type="radio" value="1" name="payment" id="payment1"
                                        required>
                                    <label class="form-check-label pt-1" for="payment1">Thanh Toán Bằng Thẻ</label>
                                </div>
                                <span class="bi bi-credit-card-2-back"></span>
                            </h2>
                            <div id="collapseCC" class="accordion-collapse collapse show"
                                data-bs-parent="#accordionPayment">
                                <div class="accordion-body">
                                    <div class="mb-3">
                                        <label class="form-label">Số Thẻ</label>
                                        <input type="text" class="form-control" placeholder="">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label">Họ Và Tên Chủ Thẻ</label>
                                                <input type="text" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label">Ngày Hết Hạn</label>
                                                <input type="date" class="form-control" placeholder="DD/MM/YY">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3">
                                                <label class="form-label">CMND/CCCD</label>
                                                <input class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- PayPal -->
                        <div class="accordion-item mb-3 border">
                            <h2 class="h5 px-4 py-3 accordion-header d-flex justify-content-between align-items-center">
                                <div class="form-check w-100 collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#collapsePP" aria-expanded="false">
                                    <input class="form-check-input" type="radio" value="0" name="payment" id="payment2"
                                        required>
                                    <label class="form-check-label pt-1" for="payment2">Thanh Toán Khi Nhận Hàng</label>
                                </div>
                                <span class="bi bi-cash-coin"></span>
                            </h2>

                        </div>
                    </div>
                </div>
                <!-- Right -->
                <div class="col-lg-3">
                    <div class="card position-sticky top-0">
                        <div class="p-3 bg-light bg-opacity-10">
                            <div class="">
                                <p class="h5">Tổng tiền thanh toán:</p>
                                <p class="fs-4"><?= number_format($tong - 60000, 0, '.', '.') ?> đ</p>
                            </div>

                            <form action="" method="post">
                                <button type="submit" name="thanh_toan" class="btn btn-primary w-100 mt-2">Thanh
                                    toán</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    if (isset($_POST['thanh_toan'])) {
        $thanh_toan = $_POST['payment'];
        // Thêm mới đơn hàng
        $insert_don_hang_query = "INSERT INTO don_hang (id_nguoi_dung,tong_tien,thanh_toan,trang_thai) VALUES ($userId,$tong-60000,$thanh_toan,1)";
        $result_don_hang = $conn->query($insert_don_hang_query);

        if ($result_don_hang) {
            // Lấy id_don_hang của đơn hàng vừa tạo
            $id_don_hang = $conn->insert_id;
            $sql = "SELECT gio_hang.id_gio_hang, gio_hang.so_luong, san_pham.ten_san_pham, san_pham.gia,gio_hang.mau_sac, gio_hang.kich_thuoc, san_pham.hinh_anh, san_pham.id_san_pham
                          FROM gio_hang
                          INNER JOIN san_pham ON gio_hang.id_san_pham = san_pham.id_san_pham 
                          WHERE gio_hang.id_nguoi_dung = $userId";

            $result = $conn->query($sql);

            // Lặp qua các sản phẩm trong giỏ hàng
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $id_san_pham = $row['id_san_pham'];
                    $so_luong = $row['so_luong'];
                    $tong_gia = $so_luong * $row['gia'];
                    $id_mau_sac = $row['mau_sac'];
                    $kich_thuoc = $row['kich_thuoc'];


                    // Thêm chi tiết đơn hàng
                    $insert_chi_tiet_query = "INSERT INTO chi_tiet_don_hang (id_don_hang, id_san_pham,mau_sac,kich_thuoc, so_luong, gia) 
                                  VALUES ($id_don_hang, $id_san_pham,$id_mau_sac,'$kich_thuoc', $so_luong, $tong_gia-60000)";
                    $result_chi_tiet = $conn->query($insert_chi_tiet_query);

                    // Kiểm tra xem chi tiết đơn hàng đã được thêm thành công hay không
                    if (!$result_chi_tiet) {
                        echo "<script>alert('Lỗi khi thêm chi tiết đơn hàng');</script>";
                    } else {
                        // Xóa hết sản phẩm trong giỏ hàng của người dùng
                        $delete_gio_hang_query = "DELETE FROM gio_hang WHERE id_nguoi_dung = $userId";
                        $result_delete_gio_hang = $conn->query($delete_gio_hang_query);

                        // Kiểm tra xem việc xóa sản phẩm khỏi giỏ hàng có thành công hay không
                        if (!$result_delete_gio_hang) {
                            echo "<script>alert('Lỗi khi xóa sản phẩm khỏi giỏ hàng');</script>";
                        } else {

                            echo "<script>alert('Đặt hàng thành công');</script>";
                            echo "<script>window.location.href = 'trang_chu.php';</script>";
                        }
                    }
                    $sql_sp = "SELECT * FROM san_pham WHERE id_san_pham = $id_san_pham";
                    $result_sp = $conn->query($sql_sp);
                    if ($result_sp->num_rows > 0) {
                        while ($row_sp = $result_sp->fetch_assoc()) {
                            $so_luong_sp = $row_sp['ton_kho'];
                            $xoa_sl = "UPDATE san_pham SET ton_khoa = $so_luong_sp - $so_luong WHERE id_san_pham = $$id_san_pham";
                            if ($conn->query($xoa_sl) === TRUE) {
                            }
                        }
                    }
                }
            }
        }
    }
    ?>



    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>

</body>
<?php include 'includes/footer.php'; ?>

</html>