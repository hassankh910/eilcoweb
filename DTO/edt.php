<?php
class edt{
    private $id;
    private $cours_id;
    private $startDate;
    private $startTime;
    private $endDate;
    private $endTime;

    function __construct() {
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getCours_Id() {
        return $this->cours_id;
    }
    public function setCours_Id($cours_id) {
        $this->cours_id = $cours_id;
    }
    public function getStartTime() {
        return $this->startTime;
    }
    public function setStartTime($startTime) {
        $this->startTime = $startTime;
    }
    public function getEndDate() {
        return $this->endDate;
    }
    public function setEndDate($endDate) {
        $this->endDate = $endDate;
    }
    public function getEndTime() {
        return $this->endTime;
    }
    public function setEndTime($endTime) {
        $this->endTime = $endTime;
    }
    public function getStartDate() {
        return $this->startDate;
    }
    public function setStartDate($startDate) {
        $this->startDate = $startDate;
    }
}
