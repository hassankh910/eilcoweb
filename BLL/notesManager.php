<?php
require(__DIR__ . "/../DAL/notesRepository.php");

function addNotes($cours_id, $etudiant_id, $note)
{
    return AddNotetostudent($cours_id, $etudiant_id, $note);
}
