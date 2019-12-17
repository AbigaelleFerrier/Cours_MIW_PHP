<?php
class Response extends Model {
        public $id;
        public $id_user;
        public $id_ticket;
        public $content;
        
    public function __construct($id=null){
        parent::__construct();
        if(!is_null($id)){
            $req = $this->bdd->prepare("SELECT * FROM response WHERE id=:id");
            $req->bindValue(":id", $id);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            $this->id = $data["id"];
            $this->id_user = $data["id_user"];
            $this->id_ticket = $data["id_ticket"];
            $this->content = $data["content"];
            }
        }
        
    public function create() {
        $req = $this->bdd->prepare("INSERT INTO response (id_user, id_ticket, content) VALUE (:id_user, :id_ticket, :content)");
        $req->bindValue(":id_user"  ,$this->id_user);
        $req->bindValue(":id_ticket",$this->id_ticket);
        $req->bindValue(":content"  ,$this->content);
        $req->execute();
        $this->id = $this->bdd->lastInsertId();
    }
    
    public function update() {
        $req = $this->bdd->prepare("UPDATE response SET id = :id, id_user = :id_user, id_ticket = :id_ticket, content = :content WHERE id = :id");
        $req->bindValue(":id",$this->id);
        $req->bindValue(":id_user",$this->id_user);
        $req->bindValue(":id_ticket",$this->id_ticket);
        $req->bindValue(":content",$this->content);
        
        $req->execute();
    }

    public function delete() {
        $req = $this->bdd->prepare("DELETE FROM response WHERE id = :id");
        $req->bindValue(":id", $this->id);
        $req->execute();
    }
    
    public static function getAll(){
        $model = parent::getInstance();
        $req = $model->bdd->query("SELECT * FROM response");
        $livres = $req->fetchAll(PDO::FETCH_ASSOC);
        return $livres;
    }

    public static function getAllByIdTicket($id){
        $model = parent::getInstance();
        $req   = $model->bdd->prepare("SELECT * FROM response WHERE id_ticket = :id_ticket");
        $req->bindValue(":id_ticket",$id);
        $req->execute();
        $livres = $req->fetchAll(PDO::FETCH_ASSOC);
        return $livres;
    }
}