<?php
require_once "../../controllers/EventController.php";

$controller = new EventController();

if (isset($_GET['id'])) {
    $event = $controller->getEvent($_GET['id']);
    if (!$event) {
        echo "<h1>Événement introuvable</h1>";
        exit;
    }
} else {
    header("Location: list_events.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Événement</title>
    <link rel="stylesheet" href="/public/style.css">
</head>
<body>
    <h1>Détails de l'Événement</h1>
    <div class="event-details">
        <h2><?= htmlspecialchars($event['nom_event']) ?></h2>
        <p><strong>Date :</strong> <?= htmlspecialchars($event['date_event']) ?></p>
        <p><?= nl2br(htmlspecialchars($event['description_event'])) ?></p>
    </div>
    <a href="list_events.php">Retour à la liste des événements</a>
</body>
</html>
