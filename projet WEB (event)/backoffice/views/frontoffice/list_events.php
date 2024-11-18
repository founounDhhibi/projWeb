<?php
require_once "../../controllers/EventController.php";

$controller = new EventController();
$events = $controller->listEvents();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements</title>
</head>
<body>
    <h1>Liste des événements</h1>
    <?php while ($row = $events->fetch(PDO::FETCH_ASSOC)): ?>
        <div>
            <h3><?= htmlspecialchars($row['nom_event']) ?></h3>
            <p><?= htmlspecialchars($row['description_event']) ?></p>
            <p>Date : <?= htmlspecialchars($row['date_event']) ?></p>
        </div>
    <?php endwhile; ?>
</body>
</html>
