<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom styles for color and size options -->
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
        border: 2px solid gray;
    }

    .color-checkmark {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        border: 2px solid #fff;

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
        border: 2px solid gray;
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
    <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center p-5">
        <?php
        // Kết nối CSDL
        include 'connections/connectdb.php';

        // Truy vấn thông tin sản phẩm từ bảng san_pham
        $sql = "SELECT * FROM san_pham";
        $result = $conn->query($sql);

        // Kiểm tra xem có dữ liệu hay không
        if ($result->num_rows > 0) {
            // Xuất dữ liệu sản phẩm
            while ($row = $result->fetch_assoc()) {
                //lấy giá thấp nhất
                $gia = 0;
                $sql_gia_min = "SELECT * FROM chi_tiet_san_pham WHERE id_san_pham = {$row['id_san_pham']} ORDER BY gia ASC LIMIT 1";
                $result_gia_min = $conn->query($sql_gia_min);

                if ($result_gia_min->num_rows > 0) {
                    $row_gia_min = $result_gia_min->fetch_assoc();
                    $gia = $row_gia_min['gia'];
                }

                // lấy màu sắc
                $query_mau_sac = "SELECT DISTINCT mau_sac.ma_mau_sac, mau_sac.ten_mau_sac 
                                            FROM chi_tiet_san_pham 
                                            JOIN mau_sac ON chi_tiet_san_pham.id_mau_sac = mau_sac.id_mau_sac
                                            WHERE chi_tiet_san_pham.id_san_pham = {$row['id_san_pham']}";
                $result_mau_sac = $conn->query($query_mau_sac);

                // Kiểm tra xem có dữ liệu màu sắc hay không
                if ($result_mau_sac->num_rows > 0) {
                    // Xuất dữ liệu màu sắc
                    echo "<div class='col mb-5'>
                            <div class='card'>
                                <!-- Product image-->
                                <img class='card-img-top' src='uploads/{$row['hinh_anh']}' alt='...' />
                                <!-- Product details-->
                                <div class='card-body'>
                                    <div class='color-options'>";
                    while ($row_mau_sac = $result_mau_sac->fetch_assoc()) {
                        echo "<label class='color-option-label'>
                                <input type='radio' name='color' class='color-option' value='{$row_mau_sac['ma_mau_sac']}'>
                                <div class='color-checkmark' style='background-color: {$row_mau_sac['ma_mau_sac']};'></div>
                              </label>";
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
                        echo "<div class='size-options'>";
                        while ($row_kich_thuoc = $result_kich_thuoc->fetch_assoc()) {
                            echo "<label class='size-option-label'>
                                    <input type='radio' name='size' class='size-option' value='{$row_kich_thuoc['kich_thuoc']}'>
                                    <div class='size-checkmark text-center'>{$row_kich_thuoc['kich_thuoc']}</div>
                                  </label>";
                        }
                        echo "</div>";
                    }

                    echo "<div class='form-group'>
                            <div class='fs-5'>{$row['ten_san_pham']}</div>
                            <div class='fs-5'>{$gia} đ</div>
                        </div>
                    </div>
                    <!-- Product actions-->
                    <div class='card-footer border-top-0 bg-transparent d-flex justify-content-center'>
                        <button id='addToCartBtn' name='submit' class='btn btn-outline-dark'>Thêm vào giỏ hàng</button>
                    </div>
                </div>
            </div>
        ";
                }
            }
        }
        ?>
    </div>

</body>

</html>