<?php
require_once("connection.php");

function AddNotetostudent($cours_id, $etudiant_id, $note)
{
    $conn = openConnection();
    $addResponse = false;
    try {
        $sql = "INSERT INTO `notes`(`etudiant_id`,`cours_id`,`note`)VALUES(?,?,?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii",  $etudiant_id, $cours_id, $note);
        if ($stmt->execute())
            $addResponse = true;
        $stmt->close();
        closeConnection($conn);
    } catch (Exception $ex) {
    }
    return $addResponse;
}

?>