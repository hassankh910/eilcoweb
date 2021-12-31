<?php
class cour{
    private $id;
    private $nom;
    private $abreviation;
    private $nb_credits;
    private $prof_id;
    private $formation_id;

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
    public function getAbreviation() {
        return $this->abreviation;
    }
    public function setAbreviation($abreviation) {
        $this->abreviation = $abreviation;
    }
    public function getNb_credits() {
        return $this->nb_credits;
    }
    public function setNb_credits($nb_credits) {
        $this->nb_credits = $nb_credits;
    }
    public function getProf_id() {
        return $this->prof_id;
    }
    public function setProf_id($prof_id) {
        $this->prof_id = $prof_id;
    }
    public function getFormation_id() {
        return $this->formation_id;
    }
    public function setFormation_id($formation_id) {
        $this->formation_id = $formation_id;
    }
}
?>