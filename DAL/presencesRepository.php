<?php
require_once("connection.php");

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
