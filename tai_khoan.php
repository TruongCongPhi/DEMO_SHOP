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
    <title>Tài khoản</title>


    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>




    <style type="text/css">
    header {

        background-image: url(https://anhvienmimosa.com/wp-content/uploads/2020/05/chup-anh-gia-dinh-nen-mac-gi-5.jpg);
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
        margin-left: 110px;

    }

    .avt {
        margin-left: 120px;
        margin-bottom: 50px;
    }

    /*       thay doi vi tri cua avt */
    .img-fluid {
        margin-left: 90px;
        margin-bottom: 150px;
    }
    </style>
</head>

<body>
    <?php include 'includes/navbar.php';
    include 'giohang.php';
    ?>


    <!-- start account -->
    <div class="row g-0 bg-body-secondary position-relative"
        style="width: 60%; height: 500px; margin-left: 300px; margin-top: 50px;">
        <div class="col-md-6 mb-md-0 p-md-4">
            <svg class="bd-placeholder-img w-100" width="100%" height="100" xmlns="http://www.w3.org/2000/svg"
                role="img" aria-label="Generic placeholder image" preserveAspectRatio="xMidYMid slice"
                focusable="false">
                <img src="https://trungtamytetanbinh.vn/Data/Sites/1/News/8161/123.jpg" class="img-fluid img-thumbnail"
                    alt="Responsive image" style="width: 150px; height: 150px; margin-bottom: 20px;">

            </svg>
            <p class="avt">Ảnh đại diện</p>
        </div>
        <div class="col-md-6 p-4 ps-md-0">
            <h5 class="mt-0">Hồ sơ của tôi</h5>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Tên</span>
                <input type="text" class="form-control" placeholder="Tên đăng nhập" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Tên gmail" aria-label="Tên gmail"
                    aria-describedby="basic-addon2">
                <span class="input-group-text" id="basic-addon2">@gmail.com</span>
            </div>

            <div class="mb-3">
                <label for="basic-url" class="form-label">Địa chỉ URL của bạn</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                </div>
                <div class="form-text" id="basic-addon4">Số điện thoại</div>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text"></span>
                <p>0123456789</p>
                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                <span class="input-group-text"></span>
            </div>

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="A" aria-label="Username">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" placeholder="gmail.com" aria-label="Server">
            </div>

            <div class="input-group">
                <span class="input-group-text">With textarea</span>
                <textarea class="form-control" aria-label="Ghi chú"></textarea>
            </div>
            <button type="button" class="btn btn-primary" style="margin-top: 10px">Cập nhật</button>
        </div>
    </div>

    <!-- end account -->
    <?php include 'includes/footer.php'; ?>
</body>


</html>