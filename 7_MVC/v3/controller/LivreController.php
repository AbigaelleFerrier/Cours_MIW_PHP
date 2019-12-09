<?php

class LivreController extends Controller{

    public function liste(){
        $this->set([
            'livres'  => Livre::getAll(),
            'auteurs' => Auteur::getAll()
        ]);
        $this->render('liste');
    }

    public function detail(){
        $id = (int)$_GET['id'];

        $livre  = new Livre($id);
        $auteur = new Auteur($livre->id_auteur);

        $this->set([
            'livre'  => $livre,
            'auteur' => $auteur
        ]);
        $this->render('detail');
    }

    public function ajouterModifier() {
        if (isset($_GET['id'])) {
            $livre  = new Livre($_GET['id']);
            $auteur = new Auteur($livre->id_auteur);

        } else {
            $livre  = new Livre();
            $auteur = new Auteur();
        }
        
        $this->set([
            'livre'  => $livre,
            'auteur' => $auteur
        ]);
        $this->render('add-update');
    }

    public function post(){
        $livre = new Livre();
        $livre->nom       = $_POST['nom'];
        $livre->id_auteur = $_POST['id_auteur'];
        $livre->resume    = $_POST['resume'];
        $livre->isbn      = $_POST['isbn'];
        $livre->prix      = $_POST['prix'];
        
        if ($_POST['id'] != '') {
            $livre->id = $_POST['id'];
            $livre->update();
        } else {
            $livre->create();
        }
        header('Location: ' . ROOT . 'livre/liste');
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $livre = new Livre($_GET['id']);
            $livre->delete();
        }
        header('Location: ' . ROOT . 'livre/liste');
    }
}