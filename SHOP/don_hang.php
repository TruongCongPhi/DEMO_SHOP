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
    ed,
    to get the result that you can see in the preview selection body {
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
  <div class="container-fluid">

    <div class="container">
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
                  // don_hang.php

                  // Include your database connection file
                  include('connections/connectdb.php');

                  // Check if the id_gio_hang parameter is set in the URL



                  // Lấy dữ liệu từ bảng gio_hang và san_pham

                  if (isset($_GET['id_gio_hang'])) {
                    $id_gio_hang = $_GET['id_gio_hang'];
                    $userId = $_SESSION['id'];

                    // Fetch products related to the given id_gio_hang from the database
                    $sql = "SELECT gio_hang.id_gio_hang, gio_hang.so_luong, san_pham.ten_san_pham, san_pham.gia, san_pham.mau_sac, san_pham.hinh_anh
                          FROM gio_hang
                          INNER JOIN san_pham ON gio_hang.id_san_pham = san_pham.id_san_pham 
                          WHERE gio_hang.id_nguoi_dung = $userId";

                    $result = $conn->query($sql);

                    // Display the products in the order
                    $tong = 0;
                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        $mau_sac = $row['mau_sac'];
                        require_once('function.php');
                        $ten_mau_sac = getColorName($mau_sac);
                        $so_luong = $row['so_luong'];
                        $tong_gia_sp = $so_luong * $row['gia'];
                        $tong += $tong_gia_sp;

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
                          <td class="text-end"><?= number_format($tong_gia_sp, 0, '.', '.') ?></td>
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
                    <td class="text-end h5"><?= number_format($tong, 0, '.', '.') ?></td>
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
                    <td class="h4 text-end"><?= number_format($tong - 60000, 0, '.', '.') ?></td>
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
            <div class="card-body">
              <h3 class="h6">Ghi chú khách hàng</h3>
              <input name="name" style="height: 100px; width: 250px;" type="text" height="100" placeholder="ghi chú" required>
            </div>
          </div>
          <div class="card mb-4">
            <!-- Shipping information -->
            <div class="card-body">
              <h3 class="h6">Thông tin vận chuyển</h3>
              <strong>Thông tin</strong>
              <span>đang cập nhật</span>
              <hr>
              <h3 class="h6">Địa chỉ nhận hàng</h3>
              <address>
                <strong>...</strong><br>
                Xuân Thủy, Cầu Giấy, Hà Nội<br>
                <abbr title="Phone">SDT:</abbr> (123) 456-7890
              </address>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include 'includes/footer.php'; ?>
</body>

</html>