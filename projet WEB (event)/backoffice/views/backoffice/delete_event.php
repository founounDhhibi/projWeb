<?php
require_once "../../controllers/EventController.php";

if (isset($_GET['id'])) {
    $controller = new EventController();
    $controller->deleteEvent($_GET['id']);
}
header("Location: list_events.php");
exit;
?>
