<?php

require_once('../../BLL/formationManager.php');
include_once("../../DTO/formation.php");

if (isset($_POST['submitBtn'])) {


    $nom = $_POST['nom'];

    try {
        $formation = new formation();
        $formation->setNom($nom);

        if (addnewFormation($formation)) {
            echo "<script type='text/javascript'>"
                . " window.location.href='./admin/AddFormation.php';"
                . "alert('formation added!');"
                . " </script> ";
        } else {
            echo "<script type='text/javascript'>"
                . " window.location.href='./admin/AddFormation.php';"
                .  "alert('Faild to add formation!');"
                . " </script> ";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
} else {
    echo "asdfghjk";
}
