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
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('assets/images/bg-01.jpg');">
            <div class="wrap-login100">
                <?php
                require_once('../BLL/usersManager.php');
                include_once("../DTO/user.php");

                if (isset($_POST['submitBtn'])) {
                    $username = $_POST['username'];
                    $pass = $_POST['pass'];

                    try {

                        $user = new user();
                        $user->setUsername($username);
                        $user->setPassword($pass);
                        $result = loginUser($user);
                        if ($result) {
                            $_SESSION['loggeduser'] = new user();
                            $_SESSION['loggeduser'] = serialize(UserByUsername($username));

                            if (unserialize($_SESSION['loggeduser'])->getRole() == 3) {
                                echo "<script type='text/javascript'>"
                                    . " window.location.href='./pages/prof/prof_page.php';"
                                    . "</script>";
                            } else if (unserialize($_SESSION['loggeduser'])->getRole() == 2) {
                                echo "<script type='text/javascript'>"
                                    . " window.location.href='./pages/student/student_page.php';"
                                    . "</script>";
                            } else if (unserialize($_SESSION['loggeduser'])->getRole() == 1) {
                                echo "<script type='text/javascript'>"
                                    . " window.location.href='./pages/admin/admin_page.php';"
                                    . "</script>";
                            } else if (unserialize($_SESSION['loggeduser'])->getRole() == 4) {
                                echo "<script type='text/javascript'>"
                                    . " window.location.href='./pages/secretaire/secretaire_page.php';"
                                    . "</script>";
                            }
                        } else {
                            echo "<script type='text/javascript'>"
                                . " window.location.href='index.php';"
                                . "alert('Incorect Username or Password.');"
                                . " </script> ";
                        }
                    } catch (Exception $exc) {
                        echo $exc->getTraceAsString();
                    }
                }
                ?>

                <form class="login100-form validate-form" method="POST">
                    <span>
                        <img class="logo-img m-b-20" src="assets/images/eilco-logo.png" alt="logo de l'eilco">
                    </span>
                    <div class="wrap-input100 validate-input" data-validate="Enter username">
                        <i class="fa fa-user"	></i>
                        <input class="input100" type="text" name="username" placeholder="Nom d'utilisateur" autocomplete="off">
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <i class="fa fa-lock"></i>
                        <input class="input100" type="password" name="pass" placeholder="Mots de Passe" autocomplete="off">
                    </div>



                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" name="submitBtn">
                            Connexion
                        </button>
                    </div>

                    <div class="text-center p-t-20">
                        <a class="txt1" href="../PL/pages/forgotpass.php">
                            Identifiants Oublies?
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>