

    const signUpButton = document.getElementById('signUp');
    const signInButton = document.getElementById('signIn');
    const logIn = document.getElementById('logIn');
    const register = document.getElementById('register');
    const container = document.getElementById('container');
    const username = document.getElementById('register-name');
    const pass = document.getElementById('register-pass');
    const pass2 = document.getElementById('register-pass2');
    const email = document.getElementById('register-email');
    const passLog = document.getElementById('login-pass');
    const emailLog = document.getElementById('login-email');

    signUpButton.addEventListener('click', () => {
        container.classList.add('right-panel-active');
    });

    signInButton.addEventListener('click', () => {
        container.classList.remove('right-panel-active');
    });

    function validateEmail(emailID) {
        atpos = emailID.indexOf("@");
        dotpos = emailID.lastIndexOf(".");
        
        if (atpos < 1 || ( dotpos - atpos < 2 )) {
           return false;
        }
        return( true );
    }

    // register.addEventListener('click', () => {
    //     if (username.value === '' || email.value === '' || pass.value === '' || pass2.value === '') {
    //         alert('Vui lòng điền đầy đủ thông tin yêu cầu!');
    //     } else if (pass.value !== pass2.value) {
    //         alert('Mật khẩu không trùng khớp!');
    //     } else if(pass.length <   6){  
    //         alert("Mật khẩu phải có ít nhất 6 kí tự.");    
    //     } else if (!validateEmail(email.value)) {
    //         alert('Email không hợp lệ!');
    //     }
    // });

