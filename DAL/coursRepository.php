<?php
require_once(__DIR__ . "/../DTO/cour.php");
require_once("connection.php");

function AddCours($cours)
{
    $conn = openConnection();
    $signupResponse = false;
    try {
        $sql = "INSERT INTO `cours`(`nom`,`abreviation`,`prof_id`,`credits`,`formation_id`) VALUES(?,?,?,?,?);";
        $stmt = $conn->prepare($sql);
        $nom = $cours->getNom();
        $abreviation = $cours->getAbreviation();
        $prof_id = $cours->getProf_id();
        $credits = $cours->getNb_credits();
        $formation_id = $cours->getFormation_id();
        $stmt->bind_param("ssiii", $nom, $abreviation, $prof_id, $credits, $formation_id);
        if ($stmt->execute())
            $signupResponse = true;
        $stmt->close();
        closeConnection($conn);
    } catch (Exception $ex) {
    }
    return $signupResponse;
}

function GetCours()
{
    $conn = openConnection();
    $query = "SELECT * FROM cours;";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == false) {
        closeConnection($conn);
        return null;
    }
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $cour = new cour();
        $cour->setId($row["idcours"]);
        $cour->setNom($row["nom"]);
        $cour->setAbreviation($row["abreviation"]);
        $cour->setProf_id($row["prof_id"]);
        $cour->setFormation_id($row["formation_id"]);
        $cour->setNb_credits($row["credits"]);
        $cours[$i] = $cour;
        $i++;
    }
    closeConnection($conn);
    return $cours;
}

function getCoursbystudentId($student_id)
{
    $conn = openConnection();

    $cours = null;

    $query = "select cours.* from users,cours where cours.formation_id=users.formation_id and users.iduser=5;";
    // $stmt = $conn->prepare($query);
    // $stmt->bind_param("i",$student_id);
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == false) {
        closeConnection($conn);
        return null;
    }
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $cour = new cour();
        $cour->setId($row["idcours"]);
        $cour->setNom($row["nom"]);
        $cour->setAbreviation($row["abreviation"]);
        $cour->setProf_id($row["prof_id"]);
        $cour->setFormation_id($row["formation_id"]);
        $cour->setNb_credits($row["credits"]);
        $cours[$i] = $cour;
        $i++;
    }
    closeConnection($conn);
    return $cours;
}
