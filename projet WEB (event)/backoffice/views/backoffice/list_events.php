<?php
require_once "../../controllers/EventController.php";

$controller = new EventController();
$events = $controller->listEvents();

while ($row = $events->fetch(PDO::FETCH_ASSOC)) {
    echo "<div>";
    echo "<h3>{$row['nom_event']}</h3>";
    echo "<p>{$row['description_event']}</p>";
    echo "<p>Date : {$row['date_event']}</p>";
    echo "<a href='edit_event.php?id={$row['id_event']}'>Modifier</a>";
    echo "<a href='delete_event.php?id={$row['id_event']}'>Supprimer</a>";
    echo "</div>";
}
?>
