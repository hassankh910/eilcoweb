<?php
require(__DIR__."/../DAL/coursRepository.php");

function addCour($cour)
{
    return AddCours($cour);
}

function getAllCours() {
    return GetCours();
}
function deleteCour($idcours)
{
    return deleteCourbyId($idcours);
}
function getCoursbyId($cour_id)
{
    return getCoursId($cour_id);
}

function getCoursbystudent($student_id) {
    return getCoursbystudentId($student_id);
}

function getNoteCour($student_id,$cours_id) {
    return getCoursGrade($student_id,$cours_id);
}
function getCoursbyProf($prof_id){
    return getCoursbyProfId($prof_id);
}
function getCoursbyFormationIddetails($formation_id){
return getCoursbyFormationId($formation_id);
}
?>