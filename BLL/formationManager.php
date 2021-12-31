<?php
require(__DIR__ . "/../DAL/formationRepository.php");

function getAllFormations()
{
    return GetFormations();
}

function addnewFormation($formation)
{
    return AddFormation($formation);
}

function GetFormationname($formation_id)
{
    return GetFormationbyId($formation_id);
}
