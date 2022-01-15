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

function getCoursId($cour_id)
{
    $conn = openConnection();

    $cour = null;

    $query = "select * from cours where idcours=?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $cour_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) == false) {
        closeConnection($conn);
        return null;
    }
    if ($row = mysqli_fetch_array($result)) {
        $cour = new cour();
        $cour->setId($row["idcours"]);
        $cour->setNom($row["nom"]);
        $cour->setAbreviation($row["abreviation"]);
        $cour->setProf_id($row["prof_id"]);
        $cour->setFormation_id($row["formation_id"]);
        $cour->setNb_credits($row["credits"]);
    }
    closeConnection($conn);
    return $cour;
}

function getCoursbystudentId($student_id)
{
    $conn = openConnection();

    $cours = null;

    $query = "select cours.* from users,cours where cours.formation_id=users.formation_id and users.iduser=?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $result = $stmt->get_result();
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

function getCoursGrade($student_id, $cours_id)
{
    $conn = openConnection();
    $note = null;

    try {
        $sql = "select note from notes where cours_id=? and etudiant_id =?;"; // SQL with parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $cours_id, $student_id);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $note = $row["note"];
            }
        }
        closeConnection($conn);
    } catch (Exception $ex) {
    }
    return $note;
}

function deleteCourbyId($idcours)
{
    $conn = openConnection();
    $deleteResponse = false;
    try {
        $sql = "DELETE FROM `cours` WHERE idcours=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $idcours);
        if ($stmt->execute())
            $deleteResponse = true;
        $stmt->close();
        closeConnection($conn);
    } catch (Exception $ex) {
        echo "<script>alert(" . $ex . ")</script>";
    }
    return $deleteResponse;
}

function getCoursbyProfId($prof_id)
{
    $conn = openConnection();

    $cours = null;

    $query = "select* from users  ,cours where users.iduser=? and users.role=3;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $prof_id);
    $stmt->execute();
    $result = $stmt->get_result();
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
function getCoursbyFormationId($formation_id)
{
    $conn = openConnection();

    $cours = null;

    $query = "select  * from cours where cours.formation_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $formation_id);
    $stmt->execute();
    $result = $stmt->get_result();
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