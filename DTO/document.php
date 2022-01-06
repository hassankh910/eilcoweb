<?php
class document{
    private $id;
    private $nom;
    private $lien;
    private $cours_id;
    private $date;

    function __construct() {
    }

    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getNom() {
        return $this->nom;
    }
    public function setNom($nom) {
        $this->nom = $nom;
    }
    public function getLien() {
        return $this->lien;
    }
    public function setLien($lien) {
        $this->lien = $lien;
    }
    public function getCours_id() {
        return $this->cours_id;
    }
    public function setCours_id($cours_id) {
        $this->cours_id = $cours_id;
    }
    public function getDate() {
        return $this->date;
    }
    public function setDate($date) {
        $this->date = $date;
    }
}
?>