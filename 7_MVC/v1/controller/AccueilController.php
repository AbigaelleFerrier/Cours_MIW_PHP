<?php

class AccueilController extends Controller {

    public function index(){

        /**
         * du code...
         */
        $livres = [
            ['idLivre'=>1, 'titre'=>'Nom du livre', 'auteur' => 'J.K'       , 'description' => 'Tempore quo primis auspiciis in mundanum fulgorem surgeret victura dum erunt homines Roma, ut augeretur sublimibus incrementis, foedere pacis aeternae Virtus convenit atque Fortuna plerumque dissidentes, quarum si altera defuisset, ad perfectam non venerat summitatem.'],
            ['idLivre'=>2, 'titre'=>'Nom du livre', 'auteur' => 'Lovecraft' , 'description' => 'Tempore quo primis auspiciis in mundanum fulgorem surgeret victura dum erunt homines Roma, ut augeretur sublimibus incrementis, foedere pacis aeternae Virtus convenit atque Fortuna plerumque dissidentes, quarum si altera defuisset, ad perfectam non venerat summitatem.'],
            ['idLivre'=>3, 'titre'=>'Nom du livre', 'auteur' => 'Random'    , 'description' => 'Tempore quo primis auspiciis in mundanum fulgorem surgeret victura dum erunt homines Roma, ut augeretur sublimibus incrementis, foedere pacis aeternae Virtus convenit atque Fortuna plerumque dissidentes, quarum si altera defuisset, ad perfectam non venerat summitatem.'],
        ];

        $this->set(['livres'=>$livres]);
        $this->render('index');
        //$this->render('index');

    }
}