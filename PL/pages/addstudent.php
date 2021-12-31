<?php

require_once('../../BLL/usersManager.php');
include_once("../../DTO/user.php");

if (isset($_POST['submitBtn'])) {


    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $date_de_naissance = $_POST['date_de_naissance'];
    $email_personel = $_POST['email_personel'];
    $sexe = $_POST['sexe'];
    $formation_id = $_POST['formation'];
    $phone = $_POST['phone'];
    $Adresse = $_POST['Adresse'] . $_POST['ComplementAdresse'];
    $nationalite = $_POST['nationalite'];

    try {
        $user = new user();
        $user->setPrenom($prenom);
        $user->setNom($nom);
        $user->setDate_de_naissance($date_de_naissance);
        $user->setEmail_personel($email_personel);
        $user->setSexe($sexe);
        $user->setPhone($phone);
        $user->setAdresse($Adresse);
        $user->setFormationId($formation_id);
        $user->setNationalite($nationalite);

        if (addStudent($user)) {
            echo "<script type='text/javascript'>"
                . " window.location.href='./admin/AddStudent.php';"
                . "alert('student added!');"
                . " </script> ";
        } else {
            echo "<script type='text/javascript'>"
                . " window.location.href='./admin/AddStudent.php';"
                .  "alert('Faild to add student!');"
                . " </script> ";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
} else {
    echo "asdfghjk";
}
