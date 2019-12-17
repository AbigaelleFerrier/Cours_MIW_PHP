<!-- On affiche tous les tickets -->
<h1>TICKETS</h1>
<ul>
<?php 
    foreach($tickets as $ticket) {
        echo '<li><a href="ticket/show?id='. $ticket['id'] .'">'. $ticket['title'] .'</li></a>';
    }
?>
</ul>
<a href="ticket/add">Ajouter un ticket</a>
<a href="user/">Gestion des User</a>