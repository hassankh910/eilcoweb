<?php
require_once(__DIR__."/../DTO/formation.php");
require_once("connection.php");

function AddFormation($formation)
{
    $conn = openConnection();
    $signupResponse = false;
    try {
        $sql = "INSERT INTO `formation`(`nomformation`) VALUES(?);";
        $stmt = $conn->prepare($sql);
        $nom = $formation->getNom();
        $stmt->bind_param("s", $nom);
        if ($stmt->execute())
            $signupResponse = true;
        $stmt->close();
        closeConnection($conn);
    } catch (Exception $ex) {
    }
    return $signupResponse;
}

function GetFormations()
{
    $conn = openConnection();
    $query = "SELECT * FROM formation;";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == false) {
    echo "alert('pipipipipi.');";
        closeConnection($conn);
        return null;
    }
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $formation = new formation();
        $formation->setId($row["idformation"]);
        $formation->setNom($row["nomformation"]);
        $formations[$i] = $formation;
        $i++;
    }
    closeConnection($conn);
    return $formations;
}

function GetFormationbyId($formation_id) {
    $conn = openConnection();
    $formation = null;

    try {
        $sql = "SELECT nomformation FROM formation WHERE idformation=? "; // SQL with parameters
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $formation_id);
        $stmt->execute();
        $result = $stmt->get_result(); // get the mysqli result
        if ($result->num_rows > 0) {
            if ($row = $result->fetch_assoc()) {
                $formation = $row["nomformation"];
            }
        }
        closeConnection($conn);
    } catch (Exception $ex) {
    }
    return $formation;
}
