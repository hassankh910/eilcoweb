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
    while ($row = mysqli_fetch_array($result)) {

        $notes[$row["etudiant_id"]] = $row["note"];
    }
    closeConnection($conn);
    return $notes;
}
?>