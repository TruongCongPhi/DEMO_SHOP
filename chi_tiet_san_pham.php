<?php include 'connections/connectdb.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
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
    <style>
        .color-options {
            display: flex;
        }

        .color-option-label {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .color-option {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            cursor: pointer;
            margin-right: 5px;
            display: none;
        }

        .color-option:checked+.color-checkmark {
            border: 3px solid gray;
        }

        .color-checkmark {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 2px solid #fff;
            margin-right: 5px;
        }

        .size-option-label {
            align-items: center;
            cursor: pointer;
        }

        .size-option {
            cursor: pointer;
            margin-right: 5px;
            display: none;
            width: 30px;
            height: 30px;
        }

        .size-option:checked+.size-checkmark {
            border: 3px solid gray;
        }

        .size-checkmark {
            border: 2px solid #fff;
            /* Border to provide contrast */
            width: 30px;
            height: 30px;
        }
    </style>

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
                // Kết nối CSDL
                $id_san_pham = $_GET['id_san_pham'];

                // Truy vấn thông tin sản phẩm từ bảng san_pham
                $sql = "SELECT * FROM san_pham WHERE id_san_pham = $id_san_pham ";
                $result = $conn->query($sql);

                // Kiểm tra xem có dữ liệu hay không
                if ($result->num_rows > 0) {
                    // Xuất dữ liệu sản phẩm
                    while ($row = $result->fetch_assoc()) {
                        $gia = number_format($row['gia'], 0, '.', '.');
                        // lấy màu sắc
                        $query_mau_sac = "SELECT DISTINCT mau_sac.id_mau_sac,mau_sac.ma_mau_sac, mau_sac.ten_mau_sac 
                                            FROM chi_tiet_san_pham 
                                            JOIN mau_sac ON chi_tiet_san_pham.id_mau_sac = mau_sac.id_mau_sac
                                            WHERE chi_tiet_san_pham.id_san_pham = {$row['id_san_pham']}";
                        $result_mau_sac = $conn->query($query_mau_sac);

                        // Kiểm tra xem có dữ liệu màu sắc hay không
                        if ($result_mau_sac->num_rows > 0) {
                            // Xuất dữ liệu màu sắc
                            echo "
                            <div class='col-md-6'><img class='card-img-top mb-5 mb-md-0' src='uploads/{$row['hinh_anh']}' alt='...' /></div>
                        <div class='col-md-6'>
                        <div class='small mb-1'>Mã sp:
                            8TH23W007</div>
                        <h1 class='display-5 fw-bolder'>{$row['ten_san_pham']}</h1>
                        <div class='fs-5 mb-5'>

                            <span style='font-size: 30px; color: red; margin-left: 5px;'>{$gia} đ</span>
                        </div>
                        <p style='font-weight:bold;'>Màu:</p>
                        <div> 
                        <div class='card-body'>
                                    <div class='color-options'>";
                            while ($row_mau_sac = $result_mau_sac->fetch_assoc()) {

                ?>
                                <label class='color-option-label'>
                                    <input type='radio' name='color' class='color-option' value='<?= $row_mau_sac['id_mau_sac'] ?>' id='color_<?= $row['id_san_pham'] ?>'>
                                    <div class='color-checkmark' style='background-color: <?= $row_mau_sac['ma_mau_sac'] ?>;'></div>
                                </label>
                                <?php
                            }
                            echo "</div>";

                            // lấy kích thước
                            $query_kich_thuoc = "SELECT DISTINCT kich_thuoc.id_kich_thuoc, kich_thuoc.kich_thuoc 
                                                FROM chi_tiet_san_pham 
                                                JOIN kich_thuoc ON chi_tiet_san_pham.id_kich_thuoc = kich_thuoc.id_kich_thuoc
                                                WHERE chi_tiet_san_pham.id_san_pham = {$row['id_san_pham']}";
                            $result_kich_thuoc = $conn->query($query_kich_thuoc);

                            // Kiểm tra xem có dữ liệu kích thước hay không
                            if ($result_kich_thuoc->num_rows > 0) {
                                // Xuất dữ liệu kích thước
                                echo "
                                <div class='size-options'>
                                <p class='mt-3' style='font-weight:bold;'>Kích thước:</p>";
                                while ($row_kich_thuoc = $result_kich_thuoc->fetch_assoc()) {
                                ?>
                                    <label class='size-option-label'>
                                        <input type='radio' name='size' class='size-option' value='<?= $row_kich_thuoc['kich_thuoc'] ?>' id='size_<?= $row['id_san_pham'] ?>'>
                                        <div class='size-checkmark text-center'><?= $row_kich_thuoc['kich_thuoc'] ?></div>
                                    </label>
                            <?php
                                }
                                echo "</div>";
                            }

                            ?>
                            <div class='d-flex' style='margin-top: 30px;'>
                                <input class='form-control text-center me-3' id='inputQuantity' type='num' value='1' style='max-width: 3rem' />
                                <button onclick='addToCart(<?= $row["id_san_pham"] ?>)' class='btn btn-outline-dark'>Thêm vào
                                    giỏ hàng</button>
                            </div>
                            <p style='font-weight: bold; margin-top:20px'>Mô tả</p>
                            <p><?= $row['mo_ta'] ?></p>
            </div>
<?php
                        }
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
    <script>
        function addToCart(id_san_pham) {
            console.log("Adding to cart:", id_san_pham);
            const selectedColor = document.querySelector(`input[name='color']:checked`);
            const selectedSize = document.querySelector(`input[name='size']:checked`);
            const quantity = document.getElementById('inputQuantity').value;

            if (!selectedColor || !selectedSize) {
                alert("Vui lòng chọn màu sắc và kích thước trước khi thêm vào giỏ hàng.");
                return;
            }

            const id_mau_sac = selectedColor.value;
            const kich_thuoc = selectedSize.value;


            window.location.href =
                `them_gio_hang.php?id_san_pham=${id_san_pham}&id_mau_sac=${id_mau_sac}&kich_thuoc=${kich_thuoc}&so_luong=${quantity}`;


        }
    </script>
</body>

</html>