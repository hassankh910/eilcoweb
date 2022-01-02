<?php

require_once('../../BLL/coursManager.php');
include_once("../../DTO/cour.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (deleteCour($id)) {
        echo "<script type='text/javascript'>"
            . " window.location.href='./admin/ViewCourses.php';"
            . " </script> ";
    } else {
        echo "<script type='text/javascript'>"
            . " window.location.href='./admin/ViewCourses.php';"
            . "alert('Delete Failed');"
            . " </script> ";
    }
}
