<?php

class Livre extends Model {
    public $id;
    public $nom;
    public $isbn;
    public $resume;
    public $auteur;
    public $prix;

    public function __construct($id=null){
        parent::__construct();
        if(!is_null($id)){
            $req = $this->bdd->prepare('SELECT * FROM livre WHERE id=:id');
            $req->bindValue(':id', $id);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            $this->id     = $data['id'];
            $this->nom    = $data['nom'];
            $this->isbn   = $data['isbn'];
            $this->resume = $data['resume'];
            $this->auteur = $data['auteur'];
            $this->prix   = $data['prix'];
        }
    }

    public function save(){
        if(isset($this->id)) {
            $this->create();
        }
        else {
            $this->update();
        }
    }

    public function getAll() {
        $req = $this->bdd->prepare('SELECT * FROM livre');
        $req->execute();
        $array = [];

        while ($row = $req->fetch()){
            $livre = new Livre();
            $livre->id     = $row['id'];
            $livre->nom    = $row['nom'];
            $livre->isbn   = $row['isbn'];
            $livre->resume = $row['resume'];
            $livre->auteur = $row['auteur'];
            $livre->prix   = $row['prix'];

            $array[] = $livre;
        }

        return $array;
    }


    private function create() {
        $req = $this->bdd->prepare('INSERT INTO livre (nom, isbn, resume, auteur, prix) VALUE (:nom, :isbn, :resume, :auteur, :prix)');
        $req->bindValue(':nom'      , $this->nom);
        $req->bindValue(':isbn'     , $this->isbn);
        $req->bindValue(':resume'   , $this->resume);
        $req->bindValue(':auteur'   , $this->auteur);
        $req->bindValue(':prix'     , $this->prix);
        $req->execute();
        $this->id = $this->bdd->lastInsertId();
    }

    private function update() {
        $req = $this->bdd->prepare('UPDATE livre SET nom = :nom, isbn = :isbn, resume = :resume, auteur = :auteur, prix = :prix WHERE id = :id');
        $req->bindValue(':nom'      , $this->nom);
        $req->bindValue(':isbn'     , $this->isbn);
        $req->bindValue(':resume'   , $this->resume);
        $req->bindValue(':auteur'   , $this->auteur);
        $req->bindValue(':prix'     , $this->prix);
        $req->bindValue(':id'       , $this->id);
        $req->execute();
    }

    public function delete() {
        $req = $this->bdd->prepare('DELETE FROM livre WHERE id=:id');
        $req->bindValue(':id', $this->id);
    }

}