<?php
class User extends Model {
        public $id;
        public $name;
        
    public function __construct($id=null){
        parent::__construct();
        if(!is_null($id)){
            $req = $this->bdd->prepare("SELECT * FROM user WHERE id=:id");
            $req->bindValue(":id", $id);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            $this->id = $data["id"];
            $this->name = $data["name"];
        }
    }
    
        
    public function create() {
        $req = $this->bdd->prepare("INSERT INTO user (name) VALUE (:name)");
        $req->bindValue(":name",$this->name);
        
        $req->execute();
        $this->id = $this->bdd->lastInsertId();
    }
    
    public function update() {
        $req = $this->bdd->prepare("UPDATE user SET id = :id, name = :name, WHERE id = :id");
        $req->bindValue(":id",$this->id);
        $req->bindValue(":name",$this->name);
        
        $req->execute();
    }

    public function delete() {
        $reqRESP = $this->bdd->prepare("DELETE FROM response WHERE id_user = :id");
        $reqRESP->bindValue(":id", $this->id);
        $reqRESP->execute();

        $reqSUJET = $this->bdd->prepare("DELETE FROM ticket WHERE id_user = :id");
        $reqSUJET->bindValue(":id", $this->id);
        $reqSUJET->execute();

        $reqUSER = $this->bdd->prepare("DELETE FROM user WHERE id = :id");
        $reqUSER->bindValue(":id", $this->id);
        $reqUSER->execute();        
    }
    
    public static function getAll(){
        $model = parent::getInstance();
        $req = $model->bdd->query("SELECT * FROM user");
        $livres = $req->fetchAll(PDO::FETCH_ASSOC);
        return $livres;
    }

    public static function get($id){
        $model = parent::getInstance();
        $req   = $model->bdd->prepare("SELECT * FROM user WHERE id = :id");
        $req->bindValue(":id",$id);
        $req->execute();
        $livres = $req->fetch(PDO::FETCH_ASSOC);
        return $livres;
    }
}