<?php
require_once "../../controler/events.php";

$eventController = new EventController();
if(isset($_GET["id_event"])){
    $id = $_GET["id_event"];
    $eventController->deleteEvent($id);
    header("Location:event.php");
} else {
    header("Location:event.php");
}

