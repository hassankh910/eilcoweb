<?php
require(__DIR__."/../DAL/userRepository.php");

function loginUser($user)
{
    return login($user);
}

function UserByUsername($username)
{
    return getUserByUsername($username);
}
function getAllStudents() {
    return getStudents();
}
function GetStudentsbyFormation($formation_id)
{
    return GetUserbyFormation($formation_id);
}

function getProfs() {
    return getAllProf();
}

function getProfName($prof_id) {
    return getProfbyId($prof_id);
}

function getPresence($student_id) {
    return getAttendence($student_id);
}

function addStudent($user)
{
    $username = $user->getPrenom()[0] . $user->getNom();
    $password = randomPassword();
    // $password = strtoupper( $user->getPrenom()[0]) . strtoupper( $user->getPrenom()[1]) . strtoupper($user->getNom[0]) . strtoupper($user->getNom[1]) . $user->getDate_de_naissance();
    $email_universitaire = $user->getPrenom() . "." . $user->getNom() . ".elv@eilco-ulco.fr";
    $user->setUsername($username);
    $user->setPassword($password);
    $user->setEmail_universitaire($email_universitaire);
    $user->setRole(2);
    return AddUser($user);
}

function addProf($user)
{
    $username = $user->getPrenom()[0] . $user->getNom();
    $password = randomPassword();
    // $password = strtoupper( $user->getPrenom()[0]) . strtoupper( $user->getPrenom()[1]) . strtoupper($user->getNom[0]) . strtoupper($user->getNom[1]) . $user->getDate_de_naissance();
    $email_universitaire = $user->getPrenom() . "." . $user->getNom() . ".elv@eilco-ulco.fr";
    $user->setUsername($username);
    $user->setPassword($password);
    $user->setEmail_universitaire($email_universitaire);
    $user->setRole(3);
    return AddUser($user);
}

function randomPassword()
{
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}
