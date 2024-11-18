<?php
class Event {
    private $conn;
    private $table = "event";

    public $id_event;
    public $nom_event;
    public $date_event;
    public $description_event;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table . " (nom_event, date_event, description_event) VALUES (:nom_event, :date_event, :description_event)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nom_event", $this->nom_event);
        $stmt->bindParam(":date_event", $this->date_event);
        $stmt->bindParam(":description_event", $this->description_event);
        return $stmt->execute();
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY date_event ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table . " WHERE id_event = :id_event";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_event", $this->id_event);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update() {
        $query = "UPDATE " . $this->table . " SET nom_event = :nom_event, date_event = :date_event, description_event = :description_event WHERE id_event = :id_event";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nom_event", $this->nom_event);
        $stmt->bindParam(":date_event", $this->date_event);
        $stmt->bindParam(":description_event", $this->description_event);
        $stmt->bindParam(":id_event", $this->id_event);
        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id_event = :id_event";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id_event", $this->id_event);
        return $stmt->execute();
    }
}
?>
