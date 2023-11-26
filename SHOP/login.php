<?php
ob_start();
session_start();
include 'connections/connectdb.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>

    <!-- Icon CSS -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="css/login_register.css">
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="" method="post" enctype="multipart/form-data">
                <h1>Tạo Tài Khoản</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="uil uil-facebook-f"></i></a>
                    <a href="#" class="social"><i class="uil uil-google"></i></i></a>
                    <a href="#" class="social"><i class="uil uil-twitter"></i></a>
                </div>
                <span>hoặc dùng email để tạo tài khoản.</span>
                <div class="input-container">
                    <i class="uil uil-user icon"></i>
                    <input name="name" id="register-name" type="text" placeholder="Họ và Tên" />
                </div>

                <div class="input-container">
                    <i class="uil uil-envelope-alt icon"></i>
                    <input name="email" id="register-email" type="email" placeholder="Email" />
                </div>

                <div class="input-container">
                    <i class="uil uil-lock-alt icon"></i>
                    <input name="password" id="register-pass" type="password" placeholder="Mật Khẩu" />
                </div>

                <div class="input-container">
                    <i class="uil uil-lock-alt icon"></i>
                    <input name="confirmPass" name="register" id="register-pass2" type="password"
                        placeholder="Xác Nhận Mật Khẩu" />
                </div>

                <button name="register" id="register">Đăng Ký</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="" method="post" enctype="multipart/form-data">
                <h1>Đăng Nhập</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="uil uil-facebook-f"></i></a>
                    <a href="#" class="social"><i class="uil uil-google"></i></i></a>
                    <a href="#" class="social"><i class="uil uil-twitter"></i></a>
                </div>
                <span>hoặc sử dụng tài khoản của bạn.</span>
                <div class="input-container">
                    <i class="uil uil-envelope-alt icon"></i>
                    <input name="email" id="login-email" type="email" placeholder="Email" />
                </div>
                <div class="input-container">
                    <i class="uil uil-lock-alt icon"></i>
                    <input name="password" id="login-pass" type="password" placeholder="Mật Khẩu" />
                </div>
                <a href="#">Quên mật khẩu?</a>
                <button name="login" id="logIn">Đăng Nhập</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>Để tiếp tục mua hàng, vui lòng đăng nhập.</p>
                    <button class="ghost" id="signIn">Đăng nhập</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Welcome!</h1>
                    <p>Bạn chưa có tài khoản vui lòng đăng kí dưới đây</p>
                    <button class="ghost" id="signUp">ĐĂNG KÝ</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/login_register.js"></script>
</body>


</html>

<?php

if (isset($_POST['register'])) {
    global $conn;

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPass = mysqli_real_escape_string($conn, $_POST['confirmPass']);

    include 'function.php';
    checkRegister($name, $email, $password, $confirmPass);
}

?>
<?php
if (isset($_POST['login'])) {
    global $conn;

    $email = trim(mysqli_real_escape_string($conn, $_POST['email']));
    $password = trim(mysqli_real_escape_string($conn, $_POST['password']));

    include 'function.php';
    checkLogin($email, $password);
}
?>