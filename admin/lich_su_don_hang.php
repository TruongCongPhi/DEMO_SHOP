<?php
session_start();
include '../connections/connectdb.php';

if ($_SESSION['admin'] == 1) {
    if (isset($_POST['tro_lai'])) {
        header('location: admin.php');
    }
    if (isset($_POST['dang_xuat'])) {
        session_unset();
        session_destroy();
        header('location: admin.php.php');
    }
} else {
    header('location: dang_nhap.php');
    exit();
}
if (isset($_GET['action']) && isset($_GET['id'])) {
    $action = $_GET['action'];
    $orderId = $_GET['id'];

    // Xác nhận đơn hàng
    if ($action === 'confirm') {
        $updateSql = "UPDATE don_hang SET trang_thai = 2 WHERE id_don_hang = $orderId";
        $conn->query($updateSql);
    }

    // Hủy đơn hàng
    if ($action === 'cancel') {
        $updateSql = "UPDATE don_hang SET trang_thai = 0 WHERE id_don_hang = $orderId";
        $conn->query($updateSql);
    }

    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <style type="text/css">
        body {
            background: #eee;
        }

        .panel-order .row {
            border-bottom: 1px solid #ccc;
        }

        .panel-order .row:last-child {
            border: 0px;
        }

        .panel-order .row .col-md-1 {
            text-align: center;
            padding-top: 15px;
        }

        .panel-order .row .col-md-1 img {
            width: 50px;
            max-height: 50px;
        }

        .panel-order .row .row {
            border-bottom: 0;
        }

        .panel-order .row .col-md-11 {
            border-left: 1px solid #ccc;
        }

        .panel-order .row .row .col-md-12 {
            padding-top: 7px;
            padding-bottom: 7px;
        }

        .panel-order .row .row .col-md-12:last-child {
            font-size: 11px;
            color: #555;
            background: #efefef;
        }

        .panel-order .btn-group {
            margin: 0px;
            padding: 0px;
        }

        .panel-order .panel-body {
            padding-top: 0px;
            padding-bottom: 0px;
        }

        .panel-order .panel-deading {
            margin-bottom: 0;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" />

    <!-- css Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <form class="text-center p-5" method="post">
        <button class="btn btn-primary" type="submit" name="tro_lai">Trở lại </button>
        <button class="btn btn-primary" type="submit" name="dang_xuat">Đăng xuất</button>
    </form>

    <div class="container bootdey">
        <div class="panel panel-default panel-order">
            <div class="panel-heading">
                <strong>Lịch sử đơn hàng</strong>

            </div>

            <div class="panel-body">
                <?php
                // Kết nối đến cơ sở dữ liệu

                function trangThai($status)
                {
                    switch ($status) {
                        case 1:
                            return 'Chờ xác nhận';
                        case 2:
                            return 'Đã xác nhận';
                        case 3:
                            return 'Đang vận chuyển';
                        case 4:
                            return 'Giao thành công';
                        case 0:
                            return 'Đã hủy';
                        default:
                            return 'Không xác định';
                    }
                }
                function getStatusColor($status)
                {
                    switch ($status) {
                        case 1:
                            return '#ffc107'; // Chờ xác nhận - màu vàng
                        case 2:
                            return '#28a745'; // Đã xác nhận - màu xanh lá cây
                        case 3:
                            return '#007bff'; // Đang vận chuyển - màu xanh dương
                        case 4:
                            return '#17a2b8'; // Giao thành công - màu xanh lam
                        case 0:
                            return '#dc3545'; // Đã hủy - màu đỏ
                        default:
                            return '#fff'; // Mặc định
                    }
                }

                // Truy vấn để lấy thông tin từ bảng don_hang
                $sql = "SELECT * FROM don_hang";
                $result = $conn->query($sql);

                // Kiểm tra xem có dữ liệu hay không
                if ($result->num_rows > 0) {
                    // Hiển thị thông tin từng đơn hàng
                    while ($row = $result->fetch_assoc()) {
                        $statusColor = getStatusColor($row['trang_thai']);
                        echo '<div class="row border">';
                        echo '<div class="col-md-1"><img src="https://bootdey.com/img/Content/user_3.jpg" class="media-object img-thumbnail" /></div>';
                        echo '<div class="col-md-11">';
                        echo '<div class="row">';
                        echo '<div class="col-md-12">';
                        echo '<div class="pull-right "><label class="label label-info" style="background-color: ' . $statusColor . ';" >Trạng thái: ' . trangThai($row['trang_thai']) . '</label></div>';
                        echo '<span><strong> ID Đơn hàng: ' . $row['id_don_hang'] . '</strong></span> <br />';
                        echo '<a >Tổng tiền Sản phẩm: ' .  number_format($row['tong_tien'], 0, '.', '.') . 'đ</a> ';
                        echo '<a>| Giảm giá: 60.000đ</a> <br>';
                        echo '<h6>Tổng tiền phải thanh toán:  ' . number_format($row['tong_tien'] - 60000, 0, '.', '.') . 'đ</h6>';
                        echo '<a  class="btn btn-success me-2" href="?action=confirm&id=' . $row['id_don_hang'] . '" >Xác nhận</a>';
                        echo '<a  class="btn btn-danger me-2 " href="?action=cancel&id=' . $row['id_don_hang'] . '" >Hủy</a>';
                        echo '<a  class="btn btn-info " href="chi_tiet_don_hang.php?id_don_hang=' . $row['id_don_hang'] . '&id_nguoi_dung=' . $row['id_nguoi_dung'] . '" >Xem chi tiết</a>';
                        echo '</div>';
                        echo '<div class="col-md-12">Đặt hàng ngày: ' . date('m/d/Y H:i:s', strtotime($row['thoi_gian'])) . ' by <a href="tai_khoan_user.php">ID_người dùng: ' . $row['id_nguoi_dung'] . '</a></div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo "No orders found.";
                }

                // Kiểm tra xác nhận hoặc hủy đơn hàng


                // Đóng kết nối
                $conn->close();
                ?>
            </div>

        </div>
    </div>

</body>

</html>