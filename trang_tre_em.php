<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
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
    <title>Thời trang trẻ em</title>
    <!-- Favicon-->
    <link rel="stylesheet" href="css/trang_chu.css">
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
    <style>

    </style>

</head>

<body>
    <!-- Navigation-->
    <?php include 'includes/navbar.php';
    include 'giohang.php';
    ?>


    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div>
                <h2>Các sản phẩm dành cho trẻ em </h2>
            </div>
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center p-5">
                <?php

                // Truy vấn thông tin sản phẩm từ bảng san_pham
                $sql = "SELECT * FROM san_pham WHERE  do_tuoi = 1";
                $result = $conn->query($sql);

                // Kiểm tra xem có dữ liệu hay không
                if ($result->num_rows > 0) {
                    // Xuất dữ liệu sản phẩm
                    while ($row = $result->fetch_assoc()) {
                        $gia = number_format($row['gia'], 0, '.', '.');
                        // lấy màu sắc
                        $query_mau_sac = "SELECT DISTINCT mau_sac.id_mau_sac, mau_sac.ma_mau_sac, mau_sac.ten_mau_sac 
                                            FROM chi_tiet_san_pham 
                                            JOIN mau_sac ON chi_tiet_san_pham.id_mau_sac = mau_sac.id_mau_sac
                                            WHERE chi_tiet_san_pham.id_san_pham = {$row['id_san_pham']}";
                        $result_mau_sac = $conn->query($query_mau_sac);

                        // Kiểm tra xem có dữ liệu màu sắc hay không
                        if ($result_mau_sac->num_rows > 0) {
                ?>

                <div class='col mb-5'>
                    <div class='card'>


                        <!-- <input type='hidden' id='selected_color_{$row['id_san_pham']}' value='' />
                            <input type='hidden' id='selected_size_{$row['id_san_pham']}' value='' /> -->

                        <!-- Product image-->
                        <a href='chi_tiet_san_pham.php?id_san_pham=<?= $row['id_san_pham'] ?>'>
                            <img class='card-img-top' src='uploads/<?= $row['hinh_anh'] ?>' alt='...' />
                        </a>

                        <!-- Product details-->
                        <div class='card-body'>
                            <div class='color-options'>
                                <?php
                                            while ($row_mau_sac = $result_mau_sac->fetch_assoc()) {
                                            ?>

                                <label class='color-option-label'>
                                    <input type='radio' name='color' class='color-option'
                                        value='<?= $row_mau_sac['id_mau_sac'] ?>' id='color_<?= $row['id_san_pham'] ?>'>
                                    <div class='color-checkmark'
                                        style='background-color: <?= $row_mau_sac['ma_mau_sac'] ?>;'></div>
                                </label>
                                <?php
                                            }
                                            ?>

                            </div>
                            <?php

                                        // lấy kích thước
                                        $query_kich_thuoc = "SELECT DISTINCT kich_thuoc.id_kich_thuoc, kich_thuoc.kich_thuoc 
                                                FROM chi_tiet_san_pham 
                                                JOIN kich_thuoc ON chi_tiet_san_pham.id_kich_thuoc = kich_thuoc.id_kich_thuoc
                                                WHERE chi_tiet_san_pham.id_san_pham = {$row['id_san_pham']}";
                                        $result_kich_thuoc = $conn->query($query_kich_thuoc);

                                        // Kiểm tra xem có dữ liệu kích thước hay không
                                        if ($result_kich_thuoc->num_rows > 0) {
                                            // Xuất dữ liệu kích thước
                                            echo "<div class='size-options'>";
                                            while ($row_kich_thuoc = $result_kich_thuoc->fetch_assoc()) {
                                        ?>
                            <label class='size-option-label'>
                                <input type='radio' name='size' class='size-option'
                                    value='<?= $row_kich_thuoc['kich_thuoc'] ?>' id='size_<?= $row['id_san_pham'] ?>'>
                                <div class='size-checkmark text-center'><?= $row_kich_thuoc['kich_thuoc'] ?></div>
                            </label>
                            <?php
                                            }
                                            ?>
                        </div>
                        <?php
                                        }

                                ?>
                        <div class='form-group'>
                            <div class='ellipsis-text' style='font-size:18px;'>
                                <?= $row['ten_san_pham'] ?>
                            </div>
                            <div class='fw-medium' style='font-size:17px;'><?= $gia ?> đ</div>
                        </div>
                    </div>


                    <!-- Product actions-->
                    <div class='card-footer border-top-0 bg-transparent d-flex justify-content-center'>
                        <button onclick='addToCart(<?= $row["id_san_pham"] ?>)' class='btn btn-outline-dark'>Thêm vào
                            giỏ hàng</button>
                    </div>
                </div>
            </div><?php
                        }
                    }
                }
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
function addToCart(id_san_pham) {
    console.log("Adding to cart:", id_san_pham);
    const selectedColor = document.querySelector(`input[name='color']:checked`);
    const selectedSize = document.querySelector(`input[name='size']:checked`);

    if (!selectedColor || !selectedSize) {
        alert("Vui lòng chọn màu sắc và kích thước trước khi thêm vào giỏ hàng.");
        return;
    }

    const id_mau_sac = selectedColor.value;
    const kich_thuoc = selectedSize.value;

    console.log("Redirecting to:",
        `them_gio_hang.php?id_san_pham=${id_san_pham}&id_mau_sac=${id_mau_sac}&kich_thuoc=${kich_thuoc}`);
    window.location.href =
        `them_gio_hang.php?id_san_pham=${id_san_pham}&id_mau_sac=${id_mau_sac}&kich_thuoc=${kich_thuoc}`;


}
</script>


</html>