<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../js/colorpalettepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/add_product.css">
</head>

<body>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <div class="container bootdey">

        <!-- Cart -->
        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="col-lg-12 col-sm-12">
                <span class="title">Thêm Sản Phẩm</span>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="col-lg-12 col-sm-12 hero-feature">
                    <div class="table-responsive">
                        <table class="table table-bordered tbl-cart">
                            <thead>
                                <tr>
                                    <td class="hidden-xs">Ảnh</td>
                                    <td>Tên Sản Phẩm</td>
                                    <td>Size</td>
                                    <td>Màu Sắc</td>
                                    <td class="td-qty">Số Lượng</td>
                                    <td>Giá</td>
                                    <td>Danh Mục</td>
                                </tr>
                            </thead>
                            <tbody class="h-100">
                                <tr>
                                    <td class="hidden-xs">
                                        <input type="file" name="hinh_anh">
                                    </td>
                                    <td><input type="text" name="ten_san_pham" required>
                                    </td>
                                    <td>
                                        <select name="size">
                                            <option value="S" selected="selected">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XXL">XXL</option>
                                            <option value="XXXL">XXXL</option>
                                        </select>
                                    </td>
                                    <td>
                                        <label for="mau_sac">Màu Sắc:</label>
                                        <div id="colorpalettediv"></div>
                                        <input type="hidden" name="mau_sac" id="mau_sac" value="#000000">
                                        <br>
                                    </td>
                                    <td>
                                        <div class="input-group bootstrap-touchspin">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default bootstrap-touchspin-down"
                                                    type="button">-</button>
                                            </span>
                                            <span class="input-group-addon bootstrap-touchspin-prefix"
                                                style="display: none;"></span>
                                            <input type="text" name="" value="1"
                                                class="input-qty form-control text-center" style="display: block;">
                                            <span class="input-group-addon bootstrap-touchspin-postfix"
                                                style="display: none;"></span>
                                            <span class="input-group-btn">
                                                <button class="btn btn-default bootstrap-touchspin-up"
                                                    type="button">+</button>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="price"><input type="text" name="gia" required></td>
                                    <td>
                                        <select name="danh_muc">
                                            <option value="0">trẻ em</option>
                                            <option value="1">Nữ</option>
                                            <option value="2">Nam</option>
                                        </select>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-primary">Thêm</button><br><br>
                    </div>
                    <div class="btn-group btns-cart">
                        <button type="button" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Trở Về
                            Trang
                            Chủ</button>
                        <button type="button" class="btn btn-primary">Thêm Sản Phẩm</button>
                        <button type="button" class="btn btn-primary">Kiểm Tra Đơn Hàng <i
                                class="fa fa-arrow-circle-right"></i></button>
                    </div>

                </div>
            </form>

        </div>

    </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $('#colorpalettediv').colorPalettePicker({
        bootstrap: 3,
        lines: 4,
        onSelected: function(color) {
            // Cập nhật giá trị trường ẩn mau_sac
            $('#mau_sac').val(color);
        }
    });

    document.querySelector('.bootstrap-touchspin-down').addEventListener('click', function() {
        var input = document.querySelector('.input-qty');
        var currentValue = Number(input.value);
        if (currentValue > 0) {
            input.value = currentValue - 1;
        }
    });

    document.querySelector('.bootstrap-touchspin-up').addEventListener('click', function() {
        var input = document.querySelector('.input-qty');
        var currentValue = Number(input.value);
        input.value = currentValue + 1;
    });

    document.querySelector('.btn.btn-primary').addEventListener('click', function() {
        window.location.href = 'admin.html';
    });
    </script>
</body>

</html>
<?php
include('../connections/connectdb.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_san_pham = mysqli_real_escape_string($conn, $_POST['ten_san_pham']);
    $gia = mysqli_real_escape_string($conn, $_POST['gia']);
    $mau_sac = mysqli_real_escape_string($conn, $_POST['mau_sac']);
    $gioi_tinh = mysqli_real_escape_string($conn, $_POST['gioi_tinh']);
    $ton_kho = mysqli_real_escape_string($conn, $_POST['ton_kho']);
    $id_danh_muc = mysqli_real_escape_string($conn, $_POST['danh_muc']);

    // Xử lý tải ảnh lên
    $hinh_anh = $_FILES['hinh_anh']['name'];
    $temp_name = $_FILES['hinh_anh']['tmp_name'];
    $upload_dir = "../uploads/";
    move_uploaded_file($temp_name, $upload_dir . $hinh_anh);

    // Thêm vào bảng `san_pham`
    // Thêm vào bảng `san_pham`
    $sql = "INSERT INTO san_pham (ten_san_pham, gia, mau_sac, hinh_anh, gioi_tinh, ton_kho, id_danh_muc)
VALUES ('$ten_san_pham', '$gia', '$mau_sac', '$hinh_anh', '$gioi_tinh', '$ton_kho', '$id_danh_muc')";


    if (mysqli_query($conn, $sql)) {
        echo "Thêm sản phẩm thành công!";
    } else {
        echo "Lỗi khi thêm vào bảng sản phẩm: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>