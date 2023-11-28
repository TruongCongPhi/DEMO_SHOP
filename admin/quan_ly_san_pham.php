<?php
// Kết nối với cơ sở dữ liệu
include '../connections/connectdb.php';
session_start();
if ($_SESSION['admin'] == 1) {
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

// Truy vấn SQL để lấy tất cả sản phẩm
$sql = "SELECT * FROM san_pham";
$result = $conn->query($sql);

// Hiển thị danh sách sản phẩm
if ($result->num_rows > 0) {
    echo " <form method='post' class='text-center'>
    <button class='btn btn-primary' type='submit' name='tro_lai'>Trở lại </button>
    <button class='btn btn-primary' type='submit' name='dang_xuat'>Đăng xuất</button>
</form>
    <table border='1'>
    <tr>
    <th>ID</th>
    <th>Tên sản phẩm</th>
    <th>Giá</th>
    <th>Chỉnh sửa</th>
    </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>" . $row["id_san_pham"] . "</td>
        <td>" . $row["ten_san_pham"] . "</td>
        <td>" . $row["gia"] . "</td>
        <td><a href='chinh_sua_san_pham.php?id=" . $row["id_san_pham"] . "'>Chỉnh sửa</a></td>
        </tr>";
    }

    echo "</table>";
} else {
    echo "Không có sản phẩm nào.";
}

// Đóng kết nối
$conn->close();
