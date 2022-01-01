<?php
class presence
{
    private $cour_id;
    private $etudiant_id;
    private $status;
    private $date;

    function __construct()
    {
    }

    public function getCourId()
    {
        return $this->cour_id;
    }
    public function setCourId($cour_id)
    {
        $this->cour_id = $cour_id;
    }
    public function getEtudiantId()
    {
        return $this->etudiant_id;
    }
    public function setEtudiantId($etudiant_id)
    {
        $this->etudiant_id = $etudiant_id;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function getDate()
    {
        return $this->date;
    }
    public function setDate($date)
    {
        $this->date = $date;
    }
}
