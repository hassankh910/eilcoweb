<?php

require_once('../../BLL/usersManager.php');
include_once("../../DTO/user.php");

if (isset($_POST['submitBtn'])) {


    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $date_de_naissance = $_POST['date_de_naissance'];
    $email_personel = $_POST['email_personel'];
    $sexe = $_POST['sexe'];
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
        $user->setNationalite($nationalite);


        if (addProf($user)) {
            echo "<script type='text/javascript'>"
                . " window.location.href='./admin/AddProf.php';"
                . "alert('prof added!');"
                . " </script> ";
        } else {
            echo "<script type='text/javascript'>"
                . " window.location.href='./admin/AddProf.php';"
                .  "alert('Faild to add prof!');"
                . " </script> ";
        }
    } catch (Exception $exc) {
        echo $exc->getTraceAsString();
    }
} else {
    echo "asdfghjk";
}
