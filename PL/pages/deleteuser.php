<?php

require_once('../../BLL/usersManager.php');
include_once("../../DTO/user.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (deleteUser($id)) {
        echo "<script type='text/javascript'>"
        . " window.location.href='./admin/View_Students.php';"
        . " </script> ";
    } else {
        echo "<script type='text/javascript'>"
        . " window.location.href='./admin/View_Students.php';"
        . "alert('Delete Failed');"
        . " </script> ";
    }
}
