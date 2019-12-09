<?php

class AuteurController extends Controller{

    public function detail(){
        $id = (int)$_GET['id'];

        $livre  = new Livre($id);
        $auteur = new Auteur($id);

        $this->set([
            'livre'  => $livre,
            'auteur' => $auteur
        ]);
        $this->render('detail');
    }

    public function ajouterModifier() {
        if (isset($_GET['id'])) {
            $livre  = new Livre($_GET['id']);
            $auteur = new Auteur($_GET['id']);

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
        $auteur = new Auteur();
        $auteur->nom            = $_POST['nom'];
        $auteur->prenom         = $_POST['prenom'];
        $auteur->date_naissance = $_POST['date_naissance'];
        
        if ($_POST['id'] != '') {
            $auteur->id = $_POST['id'];
            $auteur->update();
        } else {
            $auteur->create();
        }
        header('Location: ' . ROOT . 'livre/liste');
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $auteur = new Auteur($_GET['id']);
            $auteur->delete();
        }
        header('Location: ' . ROOT . 'livre/liste');
    }
}