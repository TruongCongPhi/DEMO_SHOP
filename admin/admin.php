<?php
session_start();
if ($_SESSION['admin'] == 1) {
    if (isset($_POST['tro_lai'])) {
        header('location: lich_su_don_hang.php');
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
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>

<body>
    <header class="header-area overlay">
        <nav class="navbar navbar-expand-md navbar-dark">
            <div class="container">
                <a href="#" class="navbar-brand"
                    style="font-family: 'Montserrat', sans-serif; font-weight: bold;">Family Shop</a>

                <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#main-nav">
                    <span class="menu-icon-bar"></span>
                    <span class="menu-icon-bar"></span>
                    <span class="menu-icon-bar"></span>
                </button>

                <div id="main-nav" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li><a href="#" class="nav-item nav-link active">Home</a></li>
                        <li><a href="them_san_pham.php" class="nav-item nav-link">Thêm Sản Phẩm</a></li>
                        <li><a href="lich_su_don_hang.php" class="nav-item nav-link">Đơn Hàng</a></li>
                        <li><a href="quan_ly_san_pham.php" class="nav-item nav-link">Quản lý Sản phẩm</a></li>
                        <li><a href="dang_nhap.php" class="nav-item nav-link">Đăng xuất</a></li>

                    </ul>
                </div>
            </div>
        </nav>

        <div class="banner">
            <div class="container">
                <h1>Trang Admin</h1>
                <p></p>
            </div>
        </div>
    </header>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="../js/admin.js"></script>
</body>

</html>