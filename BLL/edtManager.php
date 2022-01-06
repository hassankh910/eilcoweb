<?php
require(__DIR__."/../DAL/edtRepository.php");

function edtbyformation($idformation){
    return edtforstudent($idformation);
}

function edtbyProf($idprof){
    return edtforprof($idprof);
}
?>