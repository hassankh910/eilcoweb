<?php
require_once("connection.php");
require(__DIR__ . "/../DTO/note.php");

function AddNotetostudent($cours_id, $etudiant_id, $note)
{
    $conn = openConnection();
    $addResponse = false;
    try {
        $query = "select * from notes where cours_id=? and etudiant_id=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $cours_id,$etudiant_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) == false) {
            $sql = "INSERT INTO `notes`(`etudiant_id`,`cours_id`,`note`)VALUES(?,?,?);";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iii",  $etudiant_id, $cours_id, $note);
            if ($stmt->execute())
                $addResponse = true;
            $stmt->close();
        }
        else {
            $sql = "UPDATE notes set note=? where  etudiant_id=? and cours_id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("iii", $note,$etudiant_id, $cours_id );
            if ($stmt->execute())
                $addResponse = true;
            $stmt->close();
        }
        closeConnection($conn);
    } catch (Exception $ex) {
    }
    return $addResponse;
}
function GetNotesByCoursId($cours_id)
{
    $conn = openConnection();

    $notes = null;

    $query = "select * from notes where cours_id=?";
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
        $note = new note();
        $note->setEtudiantId($row["etudiant_id"]);
        $note->setcours_id($row["cours_id"]);
        $note->setNote($row["note"]);
        $notes[$i] = $note;
        $i++;
    }
    closeConnection($conn);
    return $notes;
}
