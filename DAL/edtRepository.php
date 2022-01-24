<?php
require_once("connection.php");
function edtforstudent($idformation)
{
    $conn = openConnection();

    $edts = null;

    $query = "select idedt,cour_id,Date(endTime)as enddate,Time(endTime) as endtime ,Date(startTime)as startdate,Time(startTime) as starttime FROM emploi_du_temps,cours where cours.idcours=emploi_du_temps.cour_id and cours.formation_id=?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idformation);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) == false) {
        closeConnection($conn);
        return null;
    }
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $edt = new edt();
        $edt->setId($row['idedt']);
        $edt->setCours_Id($row['cour_id']);
        $edt->setStartDate($row['startdate']);
        $edt->setStartTime($row['starttime']);
        $edt->setEndDate($row['enddate']);
        $edt->setEndTime($row['endtime']);
        $edts[$i] = $edt;
        $i++;
    }
    closeConnection($conn);
    return $edts;
}

function edtforprof($idprof)
{
    $conn = openConnection();

    $edts = null;

    $query = "select idedt,cour_id,Date(endTime)as enddate,Time(endTime) as endtime ,Date(startTime)as startdate,Time(startTime) as starttime FROM emploi_du_temps,cours where cours.idcours=emploi_du_temps.cour_id and cours.prof_id=?;";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idprof);
    $stmt->execute();
    $result = $stmt->get_result();
    if (mysqli_num_rows($result) == false) {
        closeConnection($conn);
        return null;
    }
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        $edt = new edt();
        $edt->setId($row['idedt']);
        $edt->setCours_Id($row['cour_id']);
        $edt->setStartDate($row['startdate']);
        $edt->setStartTime($row['starttime']);
        $edt->setEndDate($row['enddate']);
        $edt->setEndTime($row['endtime']);
        $edts[$i] = $edt;
        $i++;
    }
    closeConnection($conn);
    return $edts;
}

function addclassedt($cours_id, $startTime, $endTime)
{
    $conn = openConnection();
    $addResponse = false;
    try {
        $sql = "INSERT INTO `emploi_du_temps`(`cour_id`,`startTime`,`endTime`)VALUES(?,?,?);";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $cours_id, $startTime, $endTime);
        if ($stmt->execute())
            $addResponse = true;
        $stmt->close();
        closeConnection($conn);
    } catch (Exception $ex) {
    }
    return $addResponse;
}

function removeedt($edtid)
{
    $conn = openConnection();
    $deleteResponse = false;
    try {
        $sql = "DELETE FROM `emploi_du_temps`WHERE idedt=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $edtid);
        if ($stmt->execute())
            $deleteResponse = true;
        $stmt->close();
        closeConnection($conn);
    } catch (Exception $ex) {
    }
    return $deleteResponse;
}
