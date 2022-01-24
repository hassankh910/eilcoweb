<?php
require(__DIR__ . "/../DAL/presencesRepository.php");

function addPresence($cours_id, $etudiant_id, $status)
{
    return AddPresencetostudent($cours_id, $etudiant_id, $status);
}
function getPresenceByCours($cours_id)
{
    return getPresences($cours_id);
}

function updateStatus($presence)
{
    updatePresence($presence);
}
