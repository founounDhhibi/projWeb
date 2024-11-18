<?php
require_once "../../controllers/EventController.php";

$controller = new EventController();
$errors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'nom_event' => $_POST['nom_event'],
        'date_event' => $_POST['date_event'],
        'description_event' => $_POST['description_event'],
    ];
    $errors = $controller->createEvent($data);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un événement</title>
</head>
<body>
    <h1>Créer un événement</h1>
    <?php if (!empty($errors)): ?>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="POST" action="">
        <label>Nom de l'événement :</label>
        <input type="text" name="nom_event" value="<?= $_POST['nom_event'] ?? '' ?>"><br>

        <label>Date de l'événement :</label>
        <input type="date" name="date_event" value="<?= $_POST['date_event'] ?? '' ?>"><br>

        <label>Description :</label>
        <textarea name="description_event"><?= $_POST['description_event'] ?? '' ?></textarea><br>

        <button type="submit">Créer</button>
    </form>
</body>
</html>
