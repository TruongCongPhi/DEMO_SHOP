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
    <title>Chi tiết sản phám</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</head>

<body>
    <!-- Navigation-->
    <?php include 'includes/navbar.php';
    include 'giohang.php';
    ?>

    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <?php
                // Kiểm tra kết nối
                if ($conn->connect_error) {
                    die("Kết nối thất bại: " . $conn->connect_error);
                }
                isset($_GET['id_san_pham']) ? $id_san_pham = $_GET['id_san_pham'] : '';
                if (!empty($_GET['id_san_pham'])) {
                    // Truy vấn dữ liệu từ bảng san_pham
                    $sql = "SELECT * FROM san_pham WHERE id_san_pham = $id_san_pham";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {

                        // Xuất dữ liệu từ bảng
                        $row = $result->fetch_assoc();
                        $formatted_gia = number_format($row['gia'], 0, '.', '.');
                        echo "
                        <div class='col-md-6'><img class='card-img-top mb-5 mb-md-0' src='uploads/{$row['hinh_anh']}' alt='...' /></div>
                        <div class='col-md-6'>
                        <div class='small mb-1'>Mã sp:
                            8TH23W007</div>
                        <h1 class='display-5 fw-bolder'>{$row['ten_san_pham']}</h1>
                        <div class='fs-5 mb-5'>

                            <span style='font-size: 30px; color: red; margin-left: 5px;'>{$formatted_gia} đ</span>
                        </div>
                        <p style='font-weight:bold;'>Màu</p>
                        <div>
                            <button type='button' style='background-color: {$row['mau_sac']}; height: 30px; width:30px; border-radius: 100px; '></button>

                        </div>
                        <p style='font-weight:bold; margin-top: 20px;'>Chọn kích cỡ</p>
                        <div>
                            <ul class='list-group list-group-horizontal' style='margin: 10px;'>
                                <li class='list-group-item'>S</li>
                                <li class='list-group-item'>M</li>
                                <li class='list-group-item'>L</li>
                                <li class='list-group-item'>XL</li>
                            </ul>
                        </div>


                        <div class='d-flex' style='margin-top: 30px;'>
                            <input class='form-control text-center me-3' id='inputQuantity' type='num' value='' style='max-width: 3rem' />
                            <a href ='them_gio_hang.php?id_san_pham={$row['id_san_pham']}' class='btn btn-outline-dark flex-shrink-0' type='submit'>
                                <i class='bi-cart-fill me-1'></i>
                                Thêm vào giỏ hàng
                            </a>
                        </div>
                            <p style='font-weight: bold; margin-top:20px'>Mô tả</p>
                            <p >{$row['mo_ta']}</p>
                        </div>";
                    }
                }


                ?>


            </div>
        </div>
    </section>

    <!-- Footer-->
    <?php include 'includes/footer.php'; ?>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>