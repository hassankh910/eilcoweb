<?php
require_once('../../BLL/usersManager.php');
include_once("../../DTO/user.php");

if (isset($_POST['submitBtn'])) {
    $username = $_POST['username'];
    $pass = $_POST['pass'];

    try {

        $user = new user();
        $user->setUsername($username);
        $user->setPassword($pass);
        $result = loginUser($user);
        if ($result) {
            session_start();
            $_SESSION['loggeduser'] = new user();
            $_SESSION['loggeduser'] = serialize(UserByUsername($username));

            if (unserialize($_SESSION['loggeduser'])->getRole() == 3) {
                echo "<script type='text/javascript'>"
                    . " window.location.href='./prof/prof_page.php';
            </script>";
            } else if (unserialize($_SESSION['loggeduser'])->getRole() == 2) {
                echo "<script type='text/javascript'>"
                    . " window.location.href='./student/student_page.php';
            </script>";
            } else if (unserialize($_SESSION['loggeduser'])->getRole() == 1) {
                echo "<script type='text/javascript'>"
                    . " window.location.href='./admin/admin_page.php';
            </script>";
            }
        } else {
            echo "<script type='text/javascript'>"
                . " window.location.href='../index.php';"
                . "alert('Incorect Username or Password.');"
                . " </script> ";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
} else {
    echo "cxvxbnbmh,j";
}
