<?php
class note{
    private etudiant_id;
    private cours_id;
    private note;

    function __construct() {
    }
    public function getId() {
        return $this->etudiant_id;
    }
    public function setId($id) {
        $this->id = $etudiant_id;
    }
    public function getNote() {
        return $this->note;
    }
    public function setNote($note) {
        $this->note = $note;
    }
    public function getcours_id(){
        return $this->cours_id=$cours_id;
    }
    public function setcours_id($cours_id){
        $this->cours_id=$cours_id;
    }
}
?>