<?php

session_start() ;

if (isset($_SESSION["username"]))
{
    if ($_SESSION["role_user"] == "USER_ROLE" )
        header("location:../front/produits.php") ;
} else {
    header("location:../front/login.php") ;
}

require_once "../../Controller/events.php";

$eventController = new EventController();
if(isset($_GET["id_event"])){
    $id = $_GET["id_event"];
    $eventController->deleteEvent($id);
    header("Location:event.php");
} else {
    header("Location:event.php");
}

