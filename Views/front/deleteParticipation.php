<?php

session_start() ;

if (isset($_SESSION["username"]))
{
    if ($_SESSION["role_user"] == "ADMIN_ROLE" )
        header("location:../back/utilisateurs.php") ;
} else {
    header("location:../front/login.php") ;
}

require_once "../../Controller/ParticipationController.php";
if(isset($_GET['id_event']) && isset($_GET['id_user'])){
    $participationController = new ParticipationController();
    $participationController->deleteParticipation($_GET['id_event'], $_GET['id_user']);
    header("Location: event.php");
} else
    header("Location: event.php");

