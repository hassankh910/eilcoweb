<?php

require(__DIR__ . "/../DTO/document.php");
require_once("connection.php");

function getDocumentsByCours($cours_id)
{
    $conn = openConnection();

    $documents = null;

    $query = "SELECT * from document where cour_id=?;";
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
        $document = new document();
        $document->setId($row["iddocument"]);
        $document->setNom($row["nom"]);
        $document->setLien($row["lien"]);
        $document->setDate($row["Date"]);
        $documents[$i] = $document;
        $i++;
    }
    closeConnection($conn);
    return $documents;
}

function deleteDocumentById($iddoc)
{
    $conn = openConnection();
    $deleteResponse = false;
    try {
        $sql = "DELETE FROM `document`WHERE iddocument=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $iddoc);
        if ($stmt->execute() )
            $deleteResponse = true;
        $stmt->close();
        closeConnection($conn);
    } catch (Exception $ex) {
    }
    return $deleteResponse;
}

function addDoc($doc)
{
    $conn = openConnection();
    $addResponse = false;
    try {
        $sql = "INSERT INTO `document`(`nom`,`lien`,`cour_id`)VALUES(?,?,?);";
        $stmt = $conn->prepare($sql);
        $name = $doc->getNom();
        $lien = $doc->getLien();
        $coursid = $doc->getCours_id();
        $stmt->bind_param("sss", $name, $lien, $coursid);
        if ($stmt->execute())
            $addResponse = true;
        $stmt->close();
        closeConnection($conn);
    } catch (Exception $ex) {
    }
    return $addResponse;
}
