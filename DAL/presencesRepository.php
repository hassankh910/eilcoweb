<?php
require_once("connection.php");
require(__DIR__."/../DTO/presence.php");

function AddPresencetostudent($cours_id, $etudiant_id, $status)
{
    $conn = openConnection();
    $addResponse = false;
    try {
        $sql = "INSERT INTO `presence`(`etudiant_id`,`cours_id`,`status`)VALUES(?,?,?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iis",  $etudiant_id, $cours_id, $status);
        if ($stmt->execute())
            $addResponse = true;
        $stmt->close();
        closeConnection($conn);
    } catch (Exception $ex) {
    }
    return $addResponse;
}

function getPresences($cours_id)
{
    $conn = openConnection();

    $presences = null;

    $query = "select * from presence where cours_id=?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $cours_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) == false) {
        closeConnection($conn);
        return null;
    }
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $presence = new presence();
        $presence->setEtudiantId($row["etudiant_id"]);
        $presence->setCourId($row["cours_id"]);
        $presence->setStatus($row["status"]);
        $presence->setDate($row["date"]);
        $presences[$i] = $presence;
        $i++;
    }
    closeConnection($conn);
    return $presences;
}

function updatePresence($presence)
{
    $conn = openConnection();
    $updateResponse = false;
    try {
        $sql = "UPDATE  presence set status=? where etudiant_id=? and cours_id=? and date=?";
        $stmt = $conn->prepare($sql);
        $etid=$presence->getEtudiantId();
        $courid=$presence->getCourId();
        $dt= $presence->getDate() ;
        $st=$presence->getStatus();
        $stmt->bind_param("siis",$st,$etid,$courid,$dt);
        if ($stmt->execute())
            $updateResponse = true;
        $stmt->close();
        closeConnection($conn);
    } catch (Exception $ex) {
    }
    return $updateResponse;
}
