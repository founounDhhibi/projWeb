<?php
require_once "../../controler/ParticipationController.php";

$participationController= new ParticipationController();
if(isset($_GET['id_event']) && isset($_GET['id_user'])){
    $participation = new Participation(
        $_GET['id_event'],
        $_GET['id_user']
    );
    $participationController->addParticipation($participation);
    header('Location: mesParticipations.php?id_user'.$_GET['id_user']);
} else
    header('location: event.php');