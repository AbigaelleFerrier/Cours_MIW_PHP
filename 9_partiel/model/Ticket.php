<?php
class Ticket extends Model {
        public $id;
        public $id_user;
        public $title;
        public $content;
        public $priority;
        public $attached_file;
        
    public function __construct($id=null){
        parent::__construct();
        if(!is_null($id)){
            $req = $this->bdd->prepare("SELECT * FROM ticket WHERE id=:id");
            $req->bindValue(":id", $id);
            $req->execute();
            $data = $req->fetch(PDO::FETCH_ASSOC);
            $this->id = $data["id"];
            $this->id_user = $data["id_user"];
            $this->title = $data["title"];
            $this->content = $data["content"];
            $this->priority = $data["priority"];
            $this->attached_file = $data["attached_file"];
            }
        }
        
    public function create() {
        $req = $this->bdd->prepare("INSERT INTO ticket (id_user, title, content, priority, attached_file) VALUE (:id_user, :title, :content, :priority, :attached_file)");
        $req->bindValue(":id_user", $this->id_user);
        $req->bindValue(":title",$this->title);
        $req->bindValue(":content",$this->content);
        $req->bindValue(":priority",$this->priority);
        $req->bindValue(":attached_file",$this->attached_file);
        
        $req->execute();
        $this->id = $this->bdd->lastInsertId();
    }
    
    public function update() {
        $req = $this->bdd->prepare("UPDATE ticket SET id = :id, id_user = :id_user, title = :title, content = :content, priority = :priority, attached_file = :attached_file WHERE id = :id");
        $req->bindValue(":id",$this->id);
        $req->bindValue(":id_user",$this->id_user);
        $req->bindValue(":title",$this->title);
        $req->bindValue(":content",$this->content);
        $req->bindValue(":priority",$this->priority);
        $req->bindValue(":attached_file",$this->attached_file);
        
        $req->execute();
    }

    public function delete() {
        $req = $this->bdd->prepare("DELETE FROM ticket WHERE id = :id");
        $req->bindValue(":id", $this->id);
        $req->execute();
    }
    
    public static function getAll(){
        $model = parent::getInstance();
        $req = $model->bdd->query("SELECT * FROM ticket");
        $livres = $req->fetchAll(PDO::FETCH_ASSOC);
        return $livres;
    }
}