<?php

require_once('../../BLL/coursManager.php');
include_once("../../DTO/cour.php");

if (isset($_POST['submitBtn'])) {


    $nom = $_POST['nom'];
    $abrev = $_POST['abrev'];
    $prof = $_POST['prof'];
    $formation = $_POST['formation'];
    $credits = $_POST['credits'];

    try {
        $cour = new cour();
        $cour->setNom($nom);
        $cour->setAbreviation($abrev);
        $cour->setProf_id($prof);
        $cour->setFormation_id($formation);
        $cour->setNb_credits($credits);

        if (addCour($cour)) {
            echo "<script type='text/javascript'>"
                . " window.location.href='./admin/AddCourse.php';"
                . "alert('cour added!');"
                . " </script> ";
        } else {
            echo "<script type='text/javascript'>"
                . " window.location.href='./admin/AddCourse.php';"
                .  "alert('Faild to add cour!');"
                . " </script> ";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
} else {
    echo "asdfghjk";
}
