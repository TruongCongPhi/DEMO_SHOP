<?php include 'connections/connectdb.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Trang chủ</title>
    <!-- Favicon-->
    <link rel="stylesheet" href="css/bangchuyen.css">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- BĂNG CHUYỀN -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>

</head>

<body>
    <!-- Navigation-->
    <?php include 'includes/navbar.php';
    include 'giohang.php';
    ?>

    <!-- Header-->
    <header class="bg-dark ">
        <img class="img-fluid" src="https://media.canifa.com/Simiconnector/BannerSlider/b/l/blacknov_top-banner_desktop.webp" alt="">
    </header>




    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div>
                <h2>Sản phẩm mới</h2>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div id="news-slider" class="owl-carousel">
                            <?php
                            include 'connections/connectdb.php';

                            // Kiểm tra kết nối
                            if ($conn->connect_error) {
                                die("Kết nối thất bại: " . $conn->connect_error);
                            }

                            // Truy vấn dữ liệu từ bảng san_pham với điều kiện sắp xếp giảm dần theo id_san_pham và giới hạn kết quả là 10
                            $sql = "SELECT * FROM san_pham ORDER BY id_san_pham DESC LIMIT 10";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Xuất dữ liệu từ bảng
                                while ($row = $result->fetch_assoc()) {
                                    echo "<div class='col mb-5'>
                                    <div class='card'>
                                    <img class='card-img-top' src='uploads/{$row['hinh_anh']}' alt='...' />
                                    <div class='card-details'>
                                    <a href='chi_tiet_san_pham.php?id_san_pham={$row['id_san_pham']}' class='btn btn-outline-info'>Xem chi tiết</a>
                                    </div>
                                    </div>
                                    </div>";
                                }
                            } else {
                                echo "Không có sản phẩm nào trong cơ sở dữ liệu.";
                            }


                            ?>


                        </div>
                    </div>
                </div>
            </div><br>




            <div>
                <h2>Các sản phẩm trong cửa hàng </h2>
            </div>


            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center p-5">
                <?php


                // Kiểm tra kết nối
                if ($conn->connect_error) {
                    die("Kết nối thất bại: " . $conn->connect_error);
                }

                // Truy vấn dữ liệu từ bảng san_pham
                $sql = "SELECT * FROM san_pham";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {

                    // Xuất dữ liệu từ bảng
                    while ($row = $result->fetch_assoc()) {
                        $formatted_gia = number_format($row['gia'], 0, '.', '.');


                        echo "<div class='col mb-5'>
                    <div class='card '>
                  <!-- Product image-->
                  <img class='card-img-top' src='uploads/{$row['hinh_anh']}' alt='...' />
                  <!-- Product details-->

                  <div class='card-body '>
                      <div class='text-center'>
                          <!--  tên đồ-->
                          <h5 class='ten-quan-ao '>{$row['ten_san_pham']}</h5>
                          <!-- vote sao -->
                          <div class='d-flex justify-content-center small text-warning'>
                              <div class='bi-star-fill'></div>
                              <div class='bi-star-fill'></div>
                              <div class='bi-star-fill'></div>
                              <div class='bi-star-fill'></div>
                          </div>
                          <h5 class='fw-bolder'></h5>
                          <!-- Product price-->
                          {$formatted_gia} đ
                    </div>
                  </div>
                  <!-- Product actions-->
                  <div class='card-footer border-top-0 bg-transparent d-flex justify-content-center'>
                      <div class='text-center'>
                          <a class='btn btn-outline-dark me-1 p-1' href='chi_tiet_san_pham.php?id_san_pham={$row['id_san_pham']}'>Xem chi tiết</a>
                      </div>
                      <div class='text-center '>
                          <a class='btn btn-outline-dark p-1' href='them_gio_hang.php?id_san_pham={$row['id_san_pham']}'>Thêm vào giỏ hàng</a>
                      </div>
                  </div>
              </div>
          </div>";
                    }
                } else {
                    echo "Không có sản phẩm nào trong cơ sở dữ liệu.";
                }
                // Đóng kết nối

                ?>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <?php include 'includes/footer.php'; ?>


    <script src='https://code.jquery.com/jquery-1.12.0.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js'></script>

</body>
<script>
    $(document).ready(function() {
        $("#news-slider").owlCarousel({
            items: 4,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [980, 2],
            itemsMobile: [600, 1],
            navigation: true,
            navigationText: ["", ""],
            pagination: true,
            autoPlay: false
        });

    });

    $(document).ready(function() {
        $("#news-slider2").owlCarousel({
            items: 4,
            itemsDesktop: [1199, 4],
            itemsDesktopSmall: [980, 3],
            itemsMobile: [600, 1],
            navigation: true,
            navigationText: ["", ""],
            pagination: true,
            autoPlay: false
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#news-slider").owlCarousel({
            items: 4,
            itemsDesktop: [1199, 3],
            itemsDesktopSmall: [980, 2],
            itemsMobile: [600, 1],
            navigation: true,
            navigationText: ["", ""],
            pagination: true,
            autoPlay: false
        });
    });
</script>

</html>