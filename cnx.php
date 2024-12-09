<?php
class config {
    public static function getConnexion() {
        // Connexion à la base de données avec PDO
        try {
            $pdo = new PDO("mysql:host=localhost;dbname=projweb", "root", "");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo 'Erreur de connexion : ' . $e->getMessage();
        }
    }
}
?>
