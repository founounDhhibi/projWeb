<?php
require_once "../../controllers/EventController.php";

$controller = new EventController();
$errors = [];
$event = null;

if (isset($_GET['id'])) {
    $event = $controller->getEvent($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $event) {
    $data = [
        'nom_event' => $_POST['nom_event'],
        'date_event' => $_POST['date_event'],
        'description_event' => $_POST['description_event'],
    ];
    $errors = $controller->updateEvent($_GET['id'], $data);
    if (empty($errors)) {
        header("Location: list_events.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un événement</title>
</head>
<body>
    <h1>Modifier un événement</h1>
    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Nom de l'événement :</label>
        <input type="text" name="nom_event" value="<?= $event['nom_event'] ?? '' ?>"><br>

        <label>Date de l'événement :</label>
        <input type="date" name="date_event" value="<?= $event['date_event'] ?? '' ?>"><br>

        <label>Description :</label>
        <textarea name="description_event"><?= $event['description_event'] ?? '' ?></textarea><br>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
