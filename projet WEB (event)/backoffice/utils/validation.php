<?php
function validateEvent($data) {
    $errors = [];

    if (empty($data['nom_event']) || strlen($data['nom_event']) < 3) {
        $errors[] = "Le nom de l'événement doit comporter au moins 3 caractères.";
    }

    if (empty($data['date_event']) || !preg_match("/^\d{4}-\d{2}-\d{2}$/", $data['date_event'])) {
        $errors[] = "La date de l'événement est invalide.";
    }

    if (empty($data['description_event']) || strlen($data['description_event']) < 10) {
        $errors[] = "La description de l'événement doit comporter au moins 10 caractères.";
    }

    return $errors;
}
?>
