<?php
require_once "../models/Event.php";
require_once "../config/database.php";
require_once "../utils/validation.php";

class EventController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function createEvent($data) {
        $errors = validateEvent($data);
        if (!empty($errors)) {
            return $errors;
        }

        $event = new Event($this->db);
        $event->nom_event = $data['nom_event'];
        $event->date_event = $data['date_event'];
        $event->description_event = $data['description_event'];

        if ($event->create()) {
            header("Location: /backoffice/list_events.php");
        } else {
            return ["Error creating event"];
        }
    }

    public function listEvents() {
        $event = new Event($this->db);
        return $event->readAll();
    }

    public function getEvent($id_event) {
        $event = new Event($this->db);
        $event->id_event = $id_event;
        return $event->readOne();
    }

    public function updateEvent($id_event, $data) {
        $errors = validateEvent($data);
        if (!empty($errors)) {
            return $errors;
        }

        $event = new Event($this->db);
        $event->id_event = $id_event;
        $event->nom_event = $data['nom_event'];
        $event->date_event = $data['date_event'];
        $event->description_event = $data['description_event'];

        if ($event->update()) {
            header("Location: /backoffice/list_events.php");
        } else {
            return ["Error updating event"];
        }
    }

    public function deleteEvent($id_event) {
        $event = new Event($this->db);
        $event->id_event = $id_event;
        if ($event->delete()) {
            header("Location: /backoffice/list_events.php");
        }
    }
}
?>
