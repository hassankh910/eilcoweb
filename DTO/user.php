<?php
class user{
    private $id;
    private $prenom;
    private $nom;
    private $role;
    private $date_de_naissance;
    private $username;
    private $password;
    private $email_personel;
    private $email_universitaire;
    private $sexe;
    private $formation_id;
    private $phone;
    private $adresse;
    private $nationalite;

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
    public function getPrenom() {
        return $this->prenom;
    }
    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }
    public function getRole() {
        return $this->role;
    }
    public function setRole($role) {
        $this->role = $role;
    }
    public function getDate_de_naissance() {
        return $this->date_de_naissance;
    }
    public function setDate_de_naissance($date_de_naissance) {
        $this->date_de_naissance = $date_de_naissance;
    }
    public function getUsername() {
        return $this->username;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = $password;
    }
    public function getEmail_personel() {
        return $this->email_personel;
    }
    public function setEmail_personel($email_personel) {
        $this->email_personel = $email_personel;
    }
    public function getEmail_universitaire() {
        return $this->email_universitaire;
    }
    public function setEmail_universitaire($email_universitaire) {
        $this->email_universitaire = $email_universitaire;
    }
    public function getSexe() {
        return $this->sexe;
    }
    public function setSexe($sexe) {
        $this->sexe = $sexe;
    }
    public function getPhone() {
        return $this->phone;
    }
    public function setPhone($phone) {
        $this->phone = $phone;
    }
    public function getAdresse() {
        return $this->adresse;
    }
    public function setAdresse($adresse) {
        $this->adresse = $adresse;
    }
    public function getFormationId() {
        return $this->formation_id;
    }
    public function setFormationId($formation_id) {
        $this->formation_id = $formation_id;
    }
    public function getNationalite() {
        return $this->nationalite;
    }
    public function setNationalite($nationalite) {
        $this->nationalite = $nationalite;
    }
}
?>