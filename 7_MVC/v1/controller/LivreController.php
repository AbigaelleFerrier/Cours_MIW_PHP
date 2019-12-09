<?php

class LivreController extends Controller {

    public function info($id = null){
        if ($id == null) {
            die('No book ID');
        }

        /**
         * du code...
         */
        $livres = [
            ['idLivre'=>1, 'titre'=>'Nom du livre', 'auteur' => 'J.K'       , 'description' => 'Tempore quo primis auspiciis in mundanum fulgorem surgeret victura dum erunt homines Roma, ut augeretur sublimibus incrementis, foedere pacis aeternae Virtus convenit atque Fortuna plerumque dissidentes, quarum si altera defuisset, ad perfectam non venerat summitatem.'],
            ['idLivre'=>2, 'titre'=>'Nom du livre', 'auteur' => 'Lovecraft' , 'description' => 'Tempore quo primis auspiciis in mundanum fulgorem surgeret victura dum erunt homines Roma, ut augeretur sublimibus incrementis, foedere pacis aeternae Virtus convenit atque Fortuna plerumque dissidentes, quarum si altera defuisset, ad perfectam non venerat summitatem.'],
            ['idLivre'=>3, 'titre'=>'Nom du livre', 'auteur' => 'Random'    , 'description' => 'Tempore quo primis auspiciis in mundanum fulgorem surgeret victura dum erunt homines Roma, ut augeretur sublimibus incrementis, foedere pacis aeternae Virtus convenit atque Fortuna plerumque dissidentes, quarum si altera defuisset, ad perfectam non venerat summitatem.'],
        ];

        $this->set(['livre'=>$livres[$id-1]]);
        $this->render('info');
        //$this->render('index');

    }
}