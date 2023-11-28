<?php
include 'connections/connectdb.php';
session_start();

if (isset($_SESSION['id'])) {
    if (isset($_GET['id_san_pham'])) {
        $id_san_pham = $_GET['id_san_pham'];
        $id_mau_sac = $_GET['id_mau_sac'];
        $kich_thuoc = $_GET['kich_thuoc'];
        $so_luong = 1;
        if (isset($_GET['so_luong'])) {
            $so_luong = $_GET['so_luong'];
        }


        // Lấy ID người dùng từ session
        isset($_SESSION['id']) ? $userId = $_SESSION['id'] : $userId = false;


        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng của người dùng chưa
        $sql_check = "SELECT * FROM gio_hang WHERE id_nguoi_dung = $userId AND id_san_pham = $id_san_pham AND mau_sac = $id_mau_sac AND kich_thuoc = '$kich_thuoc'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            // Nếu sản phẩm đã tồn tại, tăng số lượng lên 1
            $sql_update = "UPDATE gio_hang SET so_luong = so_luong + 1 WHERE id_nguoi_dung = $userId AND id_san_pham = $id_san_pham";

            if ($conn->query($sql_update) !== TRUE) {
                echo "Có lỗi xảy ra khi cập nhật cơ sở dữ liệu: " . $conn->error;
            }
        } else {
            // Nếu sản phẩm chưa tồn tại, thêm vào giỏ hàng với số lượng là 1
            $sql_insert = "INSERT INTO gio_hang (id_nguoi_dung, id_san_pham, so_luong, mau_sac, kich_thuoc) VALUES ($userId, $id_san_pham, $so_luong, $id_mau_sac, '$kich_thuoc')";

            if ($conn->query($sql_insert) !== TRUE) {
                echo "Có lỗi xảy ra khi thêm vào giỏ hàng và cập nhật cơ sở dữ liệu: " . $conn->error;
            }
        }

        // Đóng kết nối
        $conn->close();



        header("Location: {$_SERVER['HTTP_REFERER']}");
    }
} else {

    echo "<script>alert('Vui lòng đăng nhập để mua hàng');</script>";
    echo "<script>window.location = 'trang_chu.php';</script>";
}
