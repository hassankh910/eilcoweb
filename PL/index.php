<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Eilco</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="icon" type="image/png" href="assets/images/eilco-logo.png" />
    
    <!-- Bootstraps -->
    <link rel="stylesheet" type="text/css" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    
    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/fonts/iconic/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" type="text/css" href="styles/utils.css">
    <link rel="stylesheet" type="text/css" href="styles/main.css">
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('assets/images/bg-01.jpg');">
            <div class="wrap-login100">
                <form class="login100-form validate-form" method="POST" action="pages/login_next.php">
                    <span>
                        <img class="logo-img m-b-20" src="assets/images/eilco-logo.png" alt="logo de l'eilco">
                    </span>
                    <div class="wrap-input100 validate-input" data-validate="Enter username">
                        <i class="fa fa-user"></i>
                        <input class="input100" type="text" name="username" placeholder="Username" autocomplete="off">
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <i class="fa fa-lock"></i>
                        <input class="input100" type="password" name="pass" placeholder="Password" autocomplete="off">
                    </div>

                    <div class="contact100-form-checkbox">
                        <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember" <?php if (isset($_COOKIE['username'])) {echo "checked='checked'";} ?> value='1'>
                        <label class="label-checkbox100" for="ckb1">
                            Remember me
                        </label>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="submitBtn">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-20">
                        <a class="txt1" href="#">
                            Forgot Password?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>