<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../model/rating.php');

class RatingC
{
    public function getRatingById($id_rate, $conn)
    {
        try {
            $query = "SELECT * FROM ratings WHERE id_rate = :id_rate";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id_rate', $id_rate, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    public function updateRating($id_rate, $rating, $description, $titre, $conn) {
        $query = "UPDATE ratings SET rating = :rating, description = :description, titre = :titre WHERE id_rate = :id_rate";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':rating', $rating);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':id_rate', $id_rate);
    
        return $stmt->execute();
    }
    
    public function deleteRating($id_rate)
{
    $db = getConnexion();  
    try {
        $req = $db->prepare('DELETE FROM ratings WHERE id_rate = :id');
        $req->execute([
            'id' => $id_rate,
        ]);
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}


}
?>
