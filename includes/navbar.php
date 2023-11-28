<?php include 'connections/connectdb.php';
?>
<?php
$sl_gio_hang = null;
if (isset($_SESSION['id'])) {
    // nếu người dùng đã đăng nhập
    $id_nguoi_dung = mysqli_real_escape_string($conn, $_SESSION['id']);
    $query = "SELECT COUNT(*) AS count FROM `gio_hang` WHERE `id_nguoi_dung`='$id_nguoi_dung'";
    $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
    $sl_gio_hang = (int) mysqli_fetch_assoc($result)["count"];
}
?>
<style>
.navbar-nav a.nav-link.active {
    border-bottom: 2px solid #000;
    /* Màu sắc của dòng gạch dưới khi liên kết được chọn */
}
</style>
<nav
    class="navbar navbar-expand-lg navbar-light bg-light px-2 fixed-top shadow  rounded-0 border-bottom border-secondary-subtle">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="trang_chu.php">
            <!-- logo web -->
            <img src="img/logo.png" alt="Logo" width="60px" class="d-inline-block align-text-top">
            <a href="trang_chu.php" class="navbar-brand mt-2 h1">FamilyShop</a>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item fs-5 fw-medium p-2">
                    <a class="nav-link" aria-current="page" href="trang_chu.php">Trang chủ</a>
                </li>
                <li class="nav-item fs-5 fw-medium p-2"><a class="nav-link" href="trang_nam.php">Nam</a></li>
                <li class="nav-item fs-5 fw-medium p-2"><a class="nav-link" href="trang_nu.php">Nữ</a></li>
                <li class="nav-item fs-5 fw-medium p-2"><a class="nav-link" href="trang_tre_em.php">Trẻ em</a></li>

            </ul>
            <form class="d-flex me-4" role="search">
                <input class="form-control me-1" type="search" placeholder="Nhập mặt hàng cần tìm"
                    aria-label="Tìm kiếm">
                <button class="btn btn-outline-success" type="submit">Search </button>
            </form>

            <!-- giỏ hàng -->
            <form class="d-flex me-2">
                <button class="btn btn-outline-dark" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions">
                    <i class="bi-cart-fill me-1"></i>
                    <span class="badge bg-dark text-white ms-1 rounded-pill"><?= $sl_gio_hang ?></span>
                </button>
            </form>

            <?php
            if (isset($_SESSION['id'])) {
                echo '<ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active fw-semibold btn " href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    ' . (isset($_SESSION['name']) ? $_SESSION['name'] : "") . '
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="tai_khoan.php">Tài khoản</a></li>
                        <li><a class="dropdown-item" href="dang_xuat.php">Đăng xuất</a></li>
                    </ul>
                </li>
            </ul>';
            } else {
                echo '<form>
                <a href="login.php"><button type="button" class="btn btn-outline-dark">Đăng nhập</button></a>
            </form>';
            }
            ?>


        </div>
    </div>

</nav>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Lấy địa chỉ URL hiện tại
    var currentURL = window.location.href;

    // Lặp qua tất cả các liên kết trong thanh điều hướng
    var navLinks = document.querySelectorAll('.navbar-nav a.nav-link');
    navLinks.forEach(function(link) {
        // So sánh địa chỉ URL hiện tại với href của từng liên kết
        if (link.href === currentURL) {
            // Nếu trùng khớp, thêm lớp 'active'
            link.classList.add('active');
        }
    });
});
</script>