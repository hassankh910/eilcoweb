<?php
require(__DIR__ . "/../DAL/presencesRepository.php");

function addPresence($cours_id, $etudiant_id, $status)
{
    return AddPresencetostudent($cours_id, $etudiant_id, $status);
}
