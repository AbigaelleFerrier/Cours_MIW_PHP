<?php

class AccueilController extends Controller {

    public function index(){

        /**
         * du code...
         */
        $livres = [
            ['id'=>1, 'nom'=>'Nom du livre'],
            ['id'=>2, 'nom'=>'Nom du livre 2'],
            ['id'=>3, 'nom'=>'Nom du livre 3'],
        ];

        $livre = ['id'=>3, 'nom'=>'Nom du livre 3'];

        $this->set(['livres'=>$livres]);
        $this->render('index');

    }
}