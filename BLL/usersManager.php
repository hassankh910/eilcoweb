<?php
require(__DIR__ . "/../DAL/userRepository.php");

function loginUser($user)
{
    return login($user);
}

function UserByUsername($username)
{
    return getUserByUsername($username);
}
function UserByid($id)
{
    return getUserById($id);
}
function getAllStudents()
{
    return getStudents();
}
function GetStudentsbyFormation($formation_id)
{
    return GetUserbyFormation($formation_id);
}
function GetUsersbyFormationdetail($formation_id)
{
    return GetUserbyFormationdetails($formation_id);
}
function  GetAllStudentsbycour($cours_id)
{
    return getAllStudentsbycours($cours_id);
}

function getProfs()
{
    return getAllProf();
}

function GetAllStudentsCount()
{
    return  CountS();
}

function getAllProfC()
{
    return CountP();
}

function getAllCP()
{
    return CountCP();
}

function getAllInfo()
{
    return CountInfo();
}
function getAllGEE()
{
    return CountGee();
}
function getAllGI()
{
    return CountIndu();
}
function UpdatePassword($user_id,$pass)
{
        return UpdatePass($user_id,$pass);    
}

function recoverPassword($email){
    $user = getUserByEmailPerso($email);
    sendInfobyEmail($user);
}

function getProfName($prof_id)
{
    return getProfbyId($prof_id);
}

function getPresence($student_id)
{
    return getAttendence($student_id);
}

function deleteUser($iduser)
{
    return deleteUserbyId($iduser);
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
    sendInfobyEmail($user);

    return AddUser($user);
}
function addSecretaire($user)
{
    $username = $user->getPrenom()[0] . $user->getNom();
    $password = randomPassword();
    // $password = strtoupper( $user->getPrenom()[0]) . strtoupper( $user->getPrenom()[1]) . strtoupper($user->getNom[0]) . strtoupper($user->getNom[1]) . $user->getDate_de_naissance();
    $email_universitaire = $user->getPrenom() . "." . $user->getNom() . ".elv@eilco-ulco.fr";
    $user->setUsername($username);
    $user->setPassword($password);
    $user->setEmail_universitaire($email_universitaire);
    $user->setRole(4);
    sendInfobyEmail($user);

    return AddUser($user);
}
function addProf($user)
{
    $username = $user->getPrenom()[0] . $user->getNom();
    $password = randomPassword();
    // $password = strtoupper( $user->getPrenom()[0]) . strtoupper( $user->getPrenom()[1]) . strtoupper($user->getNom[0]) . strtoupper($user->getNom[1]) . $user->getDate_de_naissance();
    $email_universitaire = $user->getPrenom() . "." . $user->getNom() . ".prof@eilco-ulco.fr";
    $user->setUsername($username);
    $user->setPassword($password);
    $user->setEmail_universitaire($email_universitaire);
    $user->setRole(3);
    sendInfobyEmail($user);
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

function sendInfobyEmail($user)
{
    $username = $user->getUsername();
    $pass = $user->getPassword();
    $email = $user->getEmail_universitaire();
    $to       = $user->getEmail_personel();
    $subject  = 'uni information';
    $message  = "Hi,\nusernname: " . $username . "\npassword: " . $pass . "\nemail: " . $email;
    $headers  = 'From: [your_gmail_account_username]@gmail.com' . "\r\n" .
        'MIME-Version: 1.0' . "\r\n" .
        'Content-type: text/html; charset=utf-8';
    if (mail($to, $subject, $message, $headers))
        echo "Email sent";
    else
        echo "Email sending failed";
}
