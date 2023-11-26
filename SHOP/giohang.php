<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Material Design for Bootstrap</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/bootstrap-shopping-carts.min.css" />
    <style>
    </style>

</head>

<body>
    <form method="post" action="">
        <div class="offcanvas offcanvas-end" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
            aria-labelledby="offcanvasWithBothOptionsLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasWithBothOptionsLabel">
                    Giỏ hàng
                </h5>
                <button type="submit" name="close_update" class="btn-close" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <?php
            include('connections/connectdb.php'); // Đảm bảo kết nối đến cơ sở dữ liệu
            $id_gio_hang = null;
            $count = 0;



            if (isset($_SESSION['id'])) {
                $userId = $_SESSION['id'];
                // Lấy dữ liệu từ bảng gio_hang và san_pham
                $sql = "SELECT gio_hang.id_gio_hang,gio_hang.so_luong, san_pham.ten_san_pham, san_pham.gia,san_pham.mau_sac, san_pham.hinh_anh, gio_hang.thoi_gian
            FROM gio_hang
            INNER JOIN san_pham ON gio_hang.id_san_pham = san_pham.id_san_pham 
            WHERE gio_hang.id_nguoi_dung = $userId";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $count =1;
                    // Hiển thị sản phẩm từ giỏ hàng
                    while ($row = $result->fetch_assoc()) {
                        $id_gio_hang = $row['id_gio_hang'];
                        $mau_sac = $row['mau_sac'];
                        require_once('function.php');
                        $ten_mau_sac = getColorName($mau_sac);
                        $so_luong = $row['so_luong'];
                        $gia = number_format($row['gia'], 0, '.', '.');
                        echo "<div class='row d-flex justify-content-center align-items-center'>
                <div class='col-12'>
                    <div class='card  rounded-0 border-dark-subtle border-top border-end-0 border-bottom-0 border-start-0'>
                        <div class='card-body rounded-0'>
                            <!-- Hiển thị thông tin sản phẩm và nút chỉnh số lượng -->
                            <div class='row'>
                                <div class='col-md-3'>
                                    <!-- Hiển thị ảnh sản phẩm -->
                                    <img src='../uploads/{$row['hinh_anh']}' class='img-fluid rounded-0' alt='{$row['ten_san_pham']}'>
                                </div>
                                <div class='col-md-8'>
                                    <!-- Hiển thị thông tin sản phẩm -->
                                    <div class='row'>
                                        <div class='col-12'>
                                            <p class='fw-normal fs-5 mb-2'>{$row['ten_san_pham']}</p>
                                        </div>
                                        <!-- Hàng màu, kích thước -->
                                        <div class='col-12'>
                                            <span class='text-muted border-end'>Size: M </span>
                                            <span class='text-muted '>Color: {$ten_mau_sac}</span>
                                        </div>

                                        <!-- Hàng nút chỉnh số lượng -->
                                        <div class='col-12'>
                                            <div class='row '>
                                                <!-- Hàng giá -->
                                                <div class='col-md-5 align-self-center'>
                                                    <h6 class='mb-0'>{$gia} đ</h6>
                                                </div>
                                                <div class='d-flex col-md-7'>
                                                    <button class='btn btn-link px-2'
                                                        onclick=\"event.preventDefault(); this.parentNode.querySelector('input[type=number]').stepDown()\">
                                                        <i class='fas fa-minus'></i>
                                                    </button>
                                                    <input id='form1' min='0' name='quantity[{$row['id_gio_hang']}]' value='{$so_luong}' type='number'
                                                        class='form-control form-control-sm' />
                                                    <button class='btn btn-link px-2'
                                                        onclick=\"event.preventDefault(); this.parentNode.querySelector('input[type=number]').stepUp()\">
                                                        <i class='fas fa-plus'></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <input type='hidden' name='id_gio_hang' value='{$row['id_gio_hang']}'>
                                <div class='col-md-1'>
                                    <button type='submit' style='width: 2px;' name ='xoa_sp' class='btn-close'></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
                    }
                } else echo "<div class='d-flex text-center'>Giỏ hàng không có sản phẩm nào</div>";
            }

            if ($count == 0) {
                echo '<div class="mt-auto card border-0 ">
                <div class="card-body m-auto">
                    <a href="" class="btn btn-warning btn-block btn-lg">Thanh toán</a>
                </div>
            </div>';
            } else {
                echo '<div class="mt-auto card border-0 ">
                <div class="card-body m-auto">
                    <a href="don_hang.php?id_gio_hang=' . $id_gio_hang . '" class="btn btn-warning btn-block btn-lg">Thanh toán</a>
                </div>
            </div>';
            }


            ?>



        </div>
    </form>
    <?php
    // Kiểm tra xem người dùng đã nhấn nút xóa chưa
    if (isset($_POST['xoa_sp'])) {
        $id_gio_hang = $_POST['id_gio_hang'];

        // Thực hiện truy vấn xóa dữ liệu từ cơ sở dữ liệu
        $delete_query = "DELETE FROM gio_hang WHERE id_gio_hang = $id_gio_hang";
        $result = $conn->query($delete_query);

        // Kiểm tra xem truy vấn đã thành công hay không
        if ($result) {
        } else {
            echo "<script>alert('Lỗi khi xóa sản phẩm');</script>";
        }
    }
    ?>
    <?php
    // Kiểm tra xem người dùng đã nhấn nút cập nhật hay không
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['quantity'])) {
        foreach ($_POST['quantity'] as $id_gio_hang => $new_quantity) {
            // Thực hiện truy vấn cập nhật số lượng trong cơ sở dữ liệu
            $update_query = "UPDATE gio_hang SET so_luong = $new_quantity WHERE id_gio_hang = $id_gio_hang";
            $result = $conn->query($update_query);

            // Kiểm tra xem truy vấn đã thành công hay không
            if (!$result) {
                echo "<script>alert('Lỗi khi cập nhật số lượng');</script>";
            }
        }
    }
    ?>




    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>


</body>

</html>