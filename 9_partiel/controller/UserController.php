<?php

class UserController extends Controller {

    public function index(){
        $this->set([
            'users'     => User::getAll(),
        ]);
        $this->render('index');
    }

    public function add() {
        if (isset($_POST['name'])) {
            
            $newUser = new User();
            $newUser->name = $_POST['name'];
            $newUser->create();            
            
            $this->set([
                'ajout' => 'Ajout effectuer',
            ]);
        }

        $this->render('add');
    }

    public function profil() {
        $this->set([
            'user' => new User($_GET['id']),
        ]);
        $this->render('profil');
    }

    public function delete() {
        $user = new User($_GET['id']);
        $user->delete();
        header('Location:'. ROOT );
    }
}