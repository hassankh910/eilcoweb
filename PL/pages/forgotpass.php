<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Eilco</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" type="image/png" href="../assets/images/eilco-logo.png" />

    <!-- Bootstraps -->
    <link rel="stylesheet" type="text/css" href="../assets/vendor/bootstrap/css/bootstrap.min.css">

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="../assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/iconic/css/material-design-iconic-font.min.css">

    <link rel="stylesheet" type="text/css" href="../styles/utils.css">
    <link rel="stylesheet" type="text/css" href="../styles/main.css">
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('../assets/images/bg-01.jpg');">
            <div class="wrap-login100"">
                <?php
                require("../../BLL/usersManager.php");
                if (isset($_POST["submitBtn"])) {
                    $email = $_POST["email"];
                    recoverPassword($email);
                    echo "<script type='text/javascript'>"
                        . " window.location.href='../index.php';"
                        . "alert('Email Envoye');"
                        . " </script> ";
                }
                if (isset($_POST["backBtn"])) {
                    echo "<script type='text/javascript'>"
                        . " window.location.href='../index.php';"
                        . " </script> ";
                }
                ?>
                <form class="login100-form validate-form" method="POST">

                    <div class="wrap-input100 validate-input" data-validate="Enter Email">
                        <input class="input100" type="email" name="email" placeholder="Email Personnel" autocomplete="off">
                    </div>

                    <div class="container-login100-form-btn">
                        <button class=" btn login100-form-btn"  style="margin-right: 10px;" name="backBtn">
                            Retouner
                        </button>
                        <button class="btn login100-form-btn " name="submitBtn">
                            Suivant
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>