<?php
include '../connections/connectdb.php';
session_start();
if ($_SESSION['admin'] == 1) {
    if (isset($_POST['tro_lai'])) {
        header('location: quan_ly_san_pham.php');
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


$product_id = $_GET['id'];

$sql = "SELECT * FROM san_pham WHERE id_san_pham = $product_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
    <form method="post" class="text-center">
        <button class="btn btn-primary" type="submit" name="tro_lai">Trở lại </button>
        <button class="btn btn-primary" type="submit" name="dang_xuat">Đăng xuất</button>
    </form>
    <form action="" method="post">
        ID: <?php echo $row["id_san_pham"]; ?><br>
        Tên sản phẩm: <input type="text" name="ten_san_pham" value="<?php echo $row["ten_san_pham"]; ?>"><br>
        Giá: <input type="text" name="gia" value="<?php echo $row["gia"]; ?>"><br>
        <!-- Thêm các trường thông tin khác của sản phẩm -->
        <input name="submit" type="submit" value="Cập nhật">
    </form>
<?php
} else {
    echo "Sản phẩm không tồn tại.";
}

if (isset($_POST['submit'])) {
    $product_name = $_POST['ten_san_pham'];
    $product_price = $_POST['gia'];

    $sql = "UPDATE san_pham SET ten_san_pham = '$product_name', gia = '$product_price' WHERE id_san_pham = $product_id";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cập nhật thành công');</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}


$conn->close();
?>