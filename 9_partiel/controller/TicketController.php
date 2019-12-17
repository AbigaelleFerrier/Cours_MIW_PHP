<?php

class TicketController extends Controller {

    public function index(){
        header('Location:Accueil');
    }

    public function show() {
        $ticket =  new Ticket($_GET['id']);

        $this->set([
            'ticket'  => $ticket,
            'user'    => new User($ticket->id_user),
            'resps'   => Response::getAllByIdTicket($_GET['id']),
            'allUsers' => User::getAll()
        ]);

        $this->render('show');
    }

    public function addResponse() {
        $newResponse = new Response();
        $newResponse->id_user   = (int)$_POST['user'];
        $newResponse->id_ticket = $_GET['id'];
        $newResponse->content   = $_POST['content'];
        $newResponse->create();

        header('Location:'. ROOT . '/ticket/show?id='. $_GET['id']);
    }

    public function add() {
        if (
            isset($_POST['user'])   && $_POST['user']   != '' &&
            isset($_POST['title'])  && $_POST['title']  != '' &&
            isset($_POST['content'])&& $_POST['content']!= ''
          ) 
        {
            
            $newTicket = new Ticket();
            $newTicket->id_user  = (int) $_POST['user'];
            $newTicket->title    = $_POST['title'];
            $newTicket->content  = $_POST['content'];
            $newTicket->priority = $_POST['priority'];

            if (isset($_FILES['fichier'])) {
                $path = ImageManager::upload('fichier');
            }

            $newTicket->attached_file = (isset($path))? $path : '';
            $newTicket->create();            
            header('Location:'.ROOT.'/ticket/show?id='.$newTicket->id);
        }

        $this->set([
            'allUsers' => User::getAll()
        ]);

        $this->render('add');
    }
}