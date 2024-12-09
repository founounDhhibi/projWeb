<?php
require_once "../../controler/ParticipationController.php";
if(isset($_GET['id_event']) && isset($_GET['id_user'])){
    $participationController = new ParticipationController();
    $participationController->deleteParticipation($_GET['id_event'], $_GET['id_user']);
    header("Location: mesParticipations.php?id_user=".$_GET['id_user']);
} else
    header("Location: event.php");

