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
