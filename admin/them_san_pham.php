<?php
// Kết nối đến cơ sở dữ liệu (thay đổi thông tin kết nối phù hợp với máy chủ MySQL của bạn)
include '../connections/connectdb.php';
session_start();
if ($_SESSION['admin'] == 1) {

    if (isset($_POST['submit'])) {
        // Lấy dữ liệu từ form
        $ten_san_pham = $_POST['ten_san_pham'];
        $mo_ta = $_POST['mo_ta'];
        $do_tuoi = $_POST['do_tuoi'];
        $gioi_tinh = $_POST['gioi_tinh'];
        $danh_muc = $_POST['danh_muc'];
        $gia = $_POST['gia'];

        // Xử lý tải ảnh lên

        $uploadCheck = 1;
        $imgPath = null;
        // Thêm câu hỏi vào bảng cau_hoi
        if (!empty($_FILES['anh']['name'])) {
            $targetDirectory = "../uploads/";
            $imgFileType = strtolower(pathinfo($_FILES['anh']['name'], PATHINFO_EXTENSION));
            $imgType = array("jpg", "jpeg", "png", "gif");
            if (!in_array($imgFileType, $imgType)) {
                $uploadCheck = 0;
            }
            if ($uploadCheck) {
                $i = 1;
                $newFileName = $_FILES['anh']['name'];

                while (file_exists($targetDirectory . $newFileName)) {
                    $newFileName = pathinfo($_FILES['anh']['name'], PATHINFO_FILENAME) . "($i)." . $imgFileType;
                    $i++;
                }

                $uploadOk = move_uploaded_file($_FILES['anh']['tmp_name'], $targetDirectory . $newFileName);
                if ($uploadOk) {
                    $imgPath = basename($_FILES["anh"]["name"]);
                }
            }
        }

        if ($uploadCheck) {
            // Thêm sản phẩm vào bảng 'san_pham'
            $sql_sanpham = "INSERT INTO san_pham (ten_san_pham, mo_ta,hinh_anh,gia, do_tuoi, gioi_tinh, id_danh_muc) VALUES ('$ten_san_pham', '$mo_ta','$imgPath', $gia, $do_tuoi, $gioi_tinh, $danh_muc)";
            if ($conn->query($sql_sanpham) === TRUE) {
                $last_id = $conn->insert_id;

                // Lấy dữ liệu chi tiết sản phẩm từ form
                $sizes = $_POST['sizes'];
                $mau_sac = $_POST['mau_sac'];
                $ten_mau = $_POST['ten_mau'];
                $so_luong = $_POST['so_luong'];
                $ton_kho = 0;

                // Thêm mã màu sắc vào bảng 'mau_sac'
                for ($i = 0; $i < count($mau_sac); $i++) {
                    $sql_mau_sac = "INSERT INTO mau_sac (ma_mau_sac, ten_mau_sac) VALUES ('$mau_sac[$i]', '$ten_mau[$i]')";
                    $conn->query($sql_mau_sac);
                    $result1 = mysqli_query($conn, $sql_mau_sac);
                }

                // Thêm chi tiết sản phẩm vào bảng 'chi_tiet_san_pham'
                for ($i = 0; $i < count($sizes); $i++) {
                    $size = $sizes[$i];
                    $mau = $mau_sac[$i];
                    $ten_mau_sac = $ten_mau[$i];
                    $gia_sp = $gia[$i];
                    $so_luong_sp = $so_luong[$i];
                    $ton_kho += $so_luong_sp;

                    // Lấy id_mau_sac từ bảng 'mau_sac'
                    $result = $conn->query("SELECT id_mau_sac FROM mau_sac WHERE ma_mau_sac = '$mau'");
                    $row = $result->fetch_assoc();
                    $id_mau_sac = $row['id_mau_sac'];

                    $sql_chitiet = "INSERT INTO chi_tiet_san_pham (id_san_pham, id_kich_thuoc, id_mau_sac, so_luong) VALUES ($last_id, $size, $id_mau_sac, $so_luong_sp)";

                    $result2 = mysqli_query($conn, $sql_chitiet);

                    // Cập nhật tồn kho trong bảng 'san_pham'

                }
                if ($result1 && $result2) {
                    $sql_tonkho = "UPDATE san_pham SET ton_kho = $ton_kho WHERE id_san_pham = $last_id";
                    $conn->query($sql_tonkho);
                    echo "<script>alert('Thêm sản phẩm thành công');</script>";
                }
            } else {
                echo "<script>alert('Không đúng định dạng, Chỉ cho phép tải lên các định dạng JPG, JPEG, PNG và GIF!');</script>";
            }
        }
    }
    if (isset($_POST['tro_lai'])) {
        header('location: admin.php');
    }
    if (isset($_POST['dang_xuat'])) {
        session_unset();
        session_destroy();
        header('location: dang_nhap.php');
    }
} else {
    header('location: dang_nhap.php');
    exit();
}




// Đóng kết nối
$conn->close();
?>
<!DOCTYPE HTML>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Thêm Sản Phẩm</title>
    <!-- Thêm các liên kết tới thư viện CSS và JavaScript cần thiết -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f8f9fa;
        font-family: 'Roboto', sans-serif;
        padding-top: 20px;
    }

    h1 {
        color: #000;
        font-weight: 600;
        text-align: center;
    }

    label {
        font-weight: bold;
    }

    .container {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table,
    th,
    td {
        border: 1px solid #dee2e6;
    }

    th,
    td {
        padding: 10px;
        text-align: center;
    }

    button {
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
    }

    button:hover {
        background-color: #0056b3;
    }
    </style>
    <script>
    function themDong() {
        var table = document.getElementById("tableChiTiet");
        var newRow = table.insertRow(table.rows.length);

        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);

        cell1.innerHTML =
            '<select class="form-control" name="sizes[]"><option value="1">S</option><option value="2">M</option><option value="3">L</option><option value="4">XL</option><option value="5">XXL</option></select>';
        cell2.innerHTML = '<input type="color" class="form-control" name="mau_sac[]">';
        cell3.innerHTML = '<input type="text" class="form-control" name="ten_mau[]">';
        cell4.innerHTML = '<input type="number" class="form-control" name="so_luong[]" placeholder="0" required>';
    }
    </script>
</head>

<body>
    <form method="post" class="text-center">
        <button class="btn btn-primary" type="submit" name="tro_lai">Trở lại </button>
        <button class="btn btn-primary" type="submit" name="dang_xuat">Đăng xuất</button>
    </form>

    <div class="container">


        <h1>Thêm Sản Phẩm</h1>
        <form action="" method="post" enctype="multipart/form-data">


            <div class="form-group">
                <label for="ten_san_pham">Tên Sản Phẩm:</label>
                <input type="text" class="form-control" name="ten_san_pham" required>
            </div>

            <div class="form-group">
                <label for="mo_ta">Mô tả:</label>
                <textarea class="form-control" style="resize: both; overflow: auto; height: 100px;" name="mo_ta"
                    required></textarea>
            </div>

            <div class="form-group">
                <label for="do_tuoi">Độ tuổi:</label>
                <select class="form-control" name="do_tuoi">
                    <option value="1">Trẻ em</option>
                    <option value="2">Người lớn</option>
                </select>
            </div>

            <div class="form-group">
                <label for="gioi_tinh">Giới Tính:</label>
                <select class="form-control" name="gioi_tinh">
                    <option value="1">Nam</option>
                    <option value="2">Nữ</option>
                    <option value="3">Unisex</option>
                </select>
            </div>

            <div class="form-group">
                <label for="danh_muc">Danh mục:</label>
                <select class="form-control" name="danh_muc">
                    <option value="1">Áo</option>
                    <option value="2">Quần</option>
                    <option value="3">Mũ</option>
                </select>
            </div>

            <div class="form-group">
                <label for="hinh_anh">Hình Ảnh:</label>
                <input type="file" class="form-control" name="anh">
            </div>

            <div class="form-group">
                <label for="gia">Giá:</label>
                <input type="number" class="form-control" name="gia" required>
            </div>

            <div class="row">
                <div class="col-12">
                    <table class="table" border="1" id="tableChiTiet">
                        <thead>
                            <tr>
                                <th>Kích Thước</th>
                                <th>Màu Sắc</th>
                                <th>Tên Màu</th>
                                <th>Số Lượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <select class="form-control" name="sizes[]">
                                        <option value="1">S</option>
                                        <option value="2">M</option>
                                        <option value="3">L</option>
                                        <option value="4">XL</option>
                                        <option value="5">XXL</option>
                                    </select>
                                </td>
                                <td><input type="color" class="form-control form-control-color" name="mau_sac[]"></td>
                                <td><input type="text" class="form-control" name="ten_mau[]"></td>
                                <td><input type="number" class="form-control" name="so_luong[]" placeholder="0"
                                        required>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <button type="button" class="btn btn-primary" onclick="themDong()">Thêm</button>

            <div class="form-group my-3 text-center">
                <button type="submit" name="submit" class="btn btn-success">Thêm Sản Phẩm</button>
            </div>
        </form>
    </div>

</body>

</html>