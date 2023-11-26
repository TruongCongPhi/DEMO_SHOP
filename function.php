<?php
include 'connections/connectdb.php';

function cleanInput(string $data)
{
	// làm sạch, giúp an toàn dữ liệu
	$data = strip_tags(trim($data));
	$data = htmlspecialchars($data);
	$data = stripslashes($data);
	return ($data);
}

function checkRegister($name, $email, $password, $confirmPass)
{
	// hàm kiểm tra đăng kí và thêm vào csdl
	global $conn;

	$name = cleanInput($name);
	$email = cleanInput($email);
	$password = cleanInput($password);


	$sql = "SELECT * from `nguoi_dung` where email= '$email'";
	$result = mysqli_query($conn, $sql);
	$num = mysqli_num_rows($result);

	if ($num > 0) {
		//người dùng đã tồn tại
		exit("Email đã được đăng kí!");
	} else {
		// thêm vào csdl
		$hashedpassword = password_hash($password, PASSWORD_DEFAULT);
		$reg = "INSERT INTO `nguoi_dung`(`ten`, `email`, `password`)
						VALUES ('$name','$email','$hashedpassword')";
		if (empty($name)) {
			exit("vui lòng nhập tên!");
		}
		filter_var($email, FILTER_VALIDATE_EMAIL) or die("Email không hợp lệ!"); // kiểm tra địa chỉ email hợp lệ
		if (strlen($password) < 6) {
			exit("Mật khẩu phải trên 6 kí tự");
		}

		if ($password !== $confirmPass) {
			exit("Mật khẩu xác nhận không khớp!");
		}
		if (mysqli_query($conn, $reg)) {
			echo '<h4" style="color: green"> Đăng kí thành công! </h4>';
			header('Refresh: 2; URL = login.php');
		} else {
			echo "Đăng kí thất bại" . mysqli_error($conn);
		}
	}
}

function checkLogin($email, $password)
{
	//hàm kiểm tra đăng nhập
	global $conn;
	if (empty($email) || empty($password)) {
		echo "Vui lòng nhập đầy đủ thông tin!";
		exit;
	}

	$query = "SELECT `password` FROM `nguoi_dung` WHERE `email`= '$email'";
	$result = mysqli_query($conn, $query);
	if ($result) {
		$row = mysqli_fetch_assoc($result);
		if ($row > 0) {
			$query2 = "SELECT * FROM `nguoi_dung` WHERE `email`='$email'";
			$result2 = mysqli_query($conn, $query2);
			if (mysqli_num_rows($result2) > 0) {
				$row = mysqli_fetch_assoc($result2);;
				$_SESSION['name'] = $row['ten'];
				$_SESSION['id'] = $row['id_nguoi_dung'];
				header('location: trang_chu.php');
			}
		} else exit("Tài khoản này chưa được đăng kí");
	}
}
// Hàm để lấy tên màu từ mã màu RGB
function getColorName($rgb)
{
	$colorPalette = array(
		'aqua' => 'rgb(0, 255, 255)',
		'azure' => 'rgb(240, 255, 255)',
		'beige' => 'rgb(245, 245, 220)',
		'black' => 'rgb(0, 0, 0)',
		'blue' => 'rgb(0, 0, 255)',
		'brown' => 'rgb(165, 42, 42)',
		'cyan' => 'rgb(0, 255, 255)',
		'darkblue' => 'rgb(0, 0, 139)',
		'darkcyan' => 'rgb(0, 139, 139)',
		'darkgrey' => 'rgb(169, 169, 169)',
		'darkgreen' => 'rgb(0, 100, 0)',
		'darkkhaki' => 'rgb(189, 183, 107)',
		'darkmagenta' => 'rgb(139, 0, 139)',
		'darkolivegreen' => 'rgb(85, 107, 47)',
		'darkorange' => 'rgb(255, 140, 0)',
		'darkorchid' => 'rgb(153, 50, 204)',
		'darkred' => 'rgb(139, 0, 0)',
		'darksalmon' => 'rgb(233, 150, 122)',
		'darkviolet' => 'rgb(148, 0, 211)',
		'fuchsia' => 'rgb(255, 0, 255)',
		'gold' => 'rgb(255, 215, 0)',
		'green' => 'rgb(0, 128, 0)',
		'indigo' => 'rgb(75, 0, 130)',
		'khaki' => 'rgb(240, 230, 140)',
		'lightblue' => 'rgb(173, 216, 230)',
		'lightcyan' => 'rgb(224, 255, 255)',
		'lightgreen' => 'rgb(144, 238, 144)',
		'lightgrey' => 'rgb(211, 211, 211)',
		'lightpink' => 'rgb(255, 182, 193)',
		'lightyellow' => 'rgb(255, 255, 224)',
		'lime' => 'rgb(0, 255, 0)',
		'magenta' => 'rgb(255, 0, 255)',
		'maroon' => 'rgb(128, 0, 0)',
		'navy' => 'rgb(0, 0, 128)',
		'olive' => 'rgb(128, 128, 0)',
		'orange' => 'rgb(255, 165, 0)',
		'pink' => 'rgb(255, 192, 203)',
		'purple' => 'rgb(128, 0, 128)',
		'violet' => 'rgb(128, 0, 128)',
		'red' => 'rgb(255, 0, 0)',
		'silver' => 'rgb(192, 192, 192)',
		'white' => 'rgb(255, 255, 255)',
		'yellow' => 'rgb(255, 255, 0)',
		'transparent' => 'rgb(255, 255, 255)'
	);
	$colorName = array_search($rgb, $colorPalette);
	return $colorName !== false ? $colorName : 'Unknown Color';
}
//bảng màu