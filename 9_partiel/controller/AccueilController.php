<?php

class AccueilController extends Controller {

    public function index(){
        $this->set([
            'tickets'   => Ticket::getAll(),
        ]);

        $this->render('index');

    }
}