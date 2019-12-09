<?php

class LivreController extends Controller{

    public function liste(){
        $livres = [
            1=>['id'=>1, 'nom'=>'Nom du livre'],
            2=>['id'=>2, 'nom'=>'Nom du livre 2'],
            3=>['id'=>3, 'nom'=>'Nom du livre 3'],
        ];

        $this->set(['livres'=>$livres]);
        $this->render('liste');
    }

    public function detail(){
        $id = (int)$_GET['id'];

        $livre = new Livre($id);

        $this->set(['livre'=>$livre]);
        $this->render('detail');
    }

    public function ajouter(){
        $livre = new Livre();
        $livre->nom = 'nom de mon livre';
        $livre->auteur = 'Romain';
        $livre->resume = 'Lorem ipsum';
        $livre->isbn = '12345678912345';
        $livre->prix = ('14.99');
        $livre->create();
    }
}