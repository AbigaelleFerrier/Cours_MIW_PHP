<?php

class Auteur extends Model {
    public $id;
    public $nom;
    public $prenom;
    public $date_naissance;


    public function __construct($id=null){
        parent::__construct();
        if(!is_null($id)){
            $req = $this->bdd->prepare('SELECT * FROM auteur WHERE id=:id');
            $req->bindValue(':id', $id);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            $this->id             = $data['id'];
            $this->nom            = $data['nom'];
            $this->prenom         = $data['prenom'];
            $this->date_naissance = $data['date_naissance'];
        }
    }

    public function create(){
        $req = $this->bdd->prepare('INSERT INTO auteur (nom, prenom, date_naissance) VALUE (:nom, :prenom, :date_naissance)');
        $req->bindValue(':nom'              , $this->nom);
        $req->bindValue(':prenom'           , $this->prenom);
        $req->bindValue(':date_naissance'   , $this->date_naissance);
        $req->execute();
        $this->id = $this->bdd->lastInsertId();
    }

    public function update() {
        $req = $this->bdd->prepare('UPDATE auteur SET nom = :nom, prenom = :prenom, date_naissance = :date_naissance WHERE id = :id');
        $req->bindValue(':id'               , $this->id);
        $req->bindValue(':nom'              , $this->nom);
        $req->bindValue(':prenom'           , $this->prenom);
        $req->bindValue(':date_naissance'   , $this->date_naissance);
        $req->execute();
    }

    public function delete() {
        $reqL = $this->bdd->prepare('DELETE FROM livre  WHERE id_auteur  = :id1');
        $reqA = $this->bdd->prepare('DELETE FROM auteur WHERE id         = :id2');
        $reqL->bindValue(':id1', $this->id);
        $reqA->bindValue(':id2', $this->id);
        $reqL->execute();
        $reqA->execute();
    }

    public static function getAll(){
        $model = parent::getInstance();
        $req = $model->bdd->query('SELECT * FROM auteur');
        $auteurs = $req->fetchAll();
        return $auteurs;
    }

    public function getLivre() {
        $req = $this->bdd->prepare('SELECT * FROM Livre WHERE id_auteur = :id ');
        $req->bindValue(':id' , $this->id);
        $req->execute();
        return $req->fetchAll();        
    }
}