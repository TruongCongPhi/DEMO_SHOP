<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/your/colorpalettepicker.css"> <!-- Đảm bảo thay đường dẫn đúng -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="../js/colorpalettepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }

        h1 {
            color: #000;
            font-weight: 600;
        }

        form {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            margin-bottom: 5px;
            display: block;
        }

        input,
        select,
        button {
            margin-bottom: 15px;
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        #colorpalettediv {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark">
        <div class="container">
            <a href="#" class="navbar-brand" style="font-family: 'Montserrat', sans-serif; font-weight: bold;">Family
                Shop</a>

            <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#main-nav">
                <span class="menu-icon-bar"></span>
                <span class="menu-icon-bar"></span>
                <span class="menu-icon-bar"></span>
            </button>

            <div id="main-nav" class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    <li><a href="admin.php" class="nav-item nav-link ">Home</a></li>
                    <li><a href="them_san_pham.php" class="nav-item nav-link active">Thêm Sản Phẩm</a></li>
                    <li><a href="lich_su_don_hang.php" class="nav-item nav-link">Đơn Hàng</a></li>
                    <li><a href="#" class="nav-item nav-link">Vận Chuyển</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <h1 style=" width:100%;" class="text-center">Thêm Sản Phẩm</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="ten_san_pham">Tên Sản Phẩm:</label>
        <input type="text" name="ten_san_pham" required><br>

        <label for="mo_ta">Mô tả:</label>
        <textarea style="resize: both; overflow: auto; width: 100%; height: 100px;" name="mo_ta" required></textarea><br>

        <label for="gia">Giá:</label>
        <input type="number" name="gia" required><br>


        <label for="gioi_tinh">Giới Tính:</label>
        <select name="gioi_tinh">
            <option value="2">Nam</option>
            <option value="1">Nữ</option>
            <option value="0">Unisex</option>
        </select><br>

        <label for="ton_kho">Số lượng:</label>
        <input type="number" name="ton_kho"><br>

        <label for="hinh_anh">Hình Ảnh:</label>
        <input type="file" name="anh"><br>

        <label for="danh_muc">Danh mục:</label>
        <select name="danh_muc">
            <option value="0">trẻ em</option>
            <option value="1">Nữ</option>
            <option value="2">Nam</option>
        </select><br>

        <Label>Kích thước: </Label>
        <select name="size">
            <option value="S" selected="selected">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XXL">XXL</option>
            <option value="XXXL">XXXL</option>
        </select>



        <label for="mau_sac">Màu Sắc:</label>
        <div id="colorpalettediv"></div>
        <input type="hidden" name="mau_sac" id="mau_sac" value="#000000">

        <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
    </form>



    <script type="text/javascript">
        $('#colorpalettediv').colorPalettePicker({
            bootstrap: 3,
            lines: 4,
            onSelected: function(color) {
                // Cập nhật giá trị trường ẩn mau_sac
                $('#mau_sac').val(color);
            }
        });
    </script>
</body>

</html>
<?php
include('../connections/connectdb.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_san_pham = mysqli_real_escape_string($conn, $_POST['ten_san_pham']);
    $mo_ta = mysqli_real_escape_string($conn, $_POST['mo_ta']);
    $gia = mysqli_real_escape_string($conn, $_POST['gia']);
    $mau_sac = mysqli_real_escape_string($conn, $_POST['mau_sac']);
    $gioi_tinh = mysqli_real_escape_string($conn, $_POST['gioi_tinh']);
    $ton_kho = mysqli_real_escape_string($conn, $_POST['ton_kho']);
    $id_danh_muc = mysqli_real_escape_string($conn, $_POST['danh_muc']);

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
        // Thêm vào bảng `san_pham`
        $sql = "INSERT INTO san_pham (ten_san_pham, mo_ta, gia, mau_sac, hinh_anh, gioi_tinh, ton_kho, id_danh_muc)
                VALUES ('$ten_san_pham','$mo_ta', '$gia', '$mau_sac', '$imgPath', '$gioi_tinh', '$ton_kho', '$id_danh_muc')";


        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Thêm sản phẩm thành công');</script>";
        } else {
            echo "Lỗi khi thêm vào bảng sản phẩm: " . mysqli_error($conn);
        }
    } else echo "<script>alert('Không đúng định dạng, Chỉ cho phép tải lên các định dạng JPG, JPEG, PNG và GIF!');</script>";

    mysqli_close($conn);
}
?>