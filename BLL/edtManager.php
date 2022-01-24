<?php
require(__DIR__ . "/../DAL/edtRepository.php");

function edtbyformation($idformation)
{
    return edtforstudent($idformation);
}

function edtbyProf($idprof)
{
    return edtforprof($idprof);
}

function addedt($cours_id, $startTime, $endTime)
{
    return addclassedt($cours_id, $startTime, $endTime);
}

function deleteedt($edtid)
{
    return removeedt($edtid);
}
