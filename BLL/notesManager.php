<?php
require(__DIR__ . "/../DAL/notesRepository.php");

function addNotes($cours_id, $etudiant_id, $note)
{
    if ($note != 0)
        return AddNotetostudent($cours_id, $etudiant_id, $note);
}
function GetnotesByCours($cours_id)
{
    return GetNotesByCoursId($cours_id);
}
