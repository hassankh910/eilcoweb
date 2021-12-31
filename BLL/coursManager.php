<?php
require(__DIR__."/../DAL/coursRepository.php");

function addCour($cour)
{
    return AddCours($cour);
}

function getAllCours() {
    return GetCours();
}

function getCoursbystudent($student_id) {
    return getCoursbystudentId($student_id);
}
?>