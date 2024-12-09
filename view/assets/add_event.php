<?php
require_once "../../controler/events.php";

$eventController = new EventController();

if( // ajouter
    !isset($_POST["event_id"]) && isset($_POST["event_nom"]) && isset($_POST["event_date"])
    && isset($_POST["event_desc"]) && isset($_FILES["event_image"])
    && isset($_POST["event_nbr_place"])  && isset($_POST["event_type"])
) {
    $imageName = $_FILES["event_image"]["name"];
    $event = new Event(
        $_POST["event_nom"],
        $_POST["event_date"],
        $_POST["event_desc"],
        $_POST["event_nbr_place"],
        $imageName,
        $_POST["event_type"]
    );
    $eventController->addEvent($event);
    header("location:event.php");
} else if( // modifier
    isset($_POST["event_id"]) && isset($_POST["event_nom"]) && isset($_POST["event_date"])
    && isset($_POST["event_desc"]) && isset($_FILES["event_image"])
    && isset($_POST["event_nbr_place"])  && isset($_POST["event_type"]) && isset($_POST["old_img"])
) {
    $imageName = $_POST["old_img"];
    $event = new Event(
        $_POST["event_nom"],
        $_POST["event_date"],
        $_POST["event_desc"],
        $_POST["event_nbr_place"],
        $imageName,
        $_POST["event_type"]
    );
    if(!empty($_FILES["event_image"]["name"]))
        $event->setImage($_FILES["event_image"]["name"]);
    $event->setIdEvent($_POST["event_id"]);
    $eventController->editEvent($event);
    header("location:event.php");
} else
    header("location:event.php");