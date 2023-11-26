<?php
session_start();
session_unset();
session_destroy();
//đang đăng xuất
header('Refresh: 1; URL = trang_chu.php');
?>