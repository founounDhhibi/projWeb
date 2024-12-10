<?php

include(__DIR__ . '/../config.php');
include(__DIR__ . '/../model/categorie.php');

class CategorieC
{
    // Fonction pour lister toutes les catégories
    public function listeCategories()
    {
        $db = getConnexion();  
        try {
            $liste = $db->query('SELECT * FROM categorie');
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Fonction pour ajouter une nouvelle catégorie
    public function addCategorie($categorie)
    {
        $db = getConnexion();  
        try {
            $req = $db->prepare('
                INSERT INTO categorie (nom_categorie, description_categorie) 
                VALUES (:nom_categorie, :description_categorie)
            ');
            $req->execute([
                'nom_categorie' => $categorie->getNomCategorie(),
                'description_categorie' => $categorie->getDescriptionCategorie(),
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Fonction pour supprimer une catégorie
    public function deleteCategorie($id_categorie)
    {
        $db = getConnexion();  
        try {
            $req = $db->prepare('
                DELETE FROM categorie WHERE id_categorie = :id
            ');
            $req->execute([
                'id' => $id_categorie,
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Fonction pour mettre à jour une catégorie
    public function updateCategorie($id_categorie, $categorie)
    {
        $db = getConnexion();  
        try {
            $req = $db->prepare('
                UPDATE categorie
                SET 
                    nom_categorie = :nom, 
                    description_categorie = :description
                WHERE id_categorie = :id
            ');
            $req->execute([
                'id' => $id_categorie,
                'nom' => $categorie->getNomCategorie(),
                'description' => $categorie->getDescriptionCategorie(),
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Fonction pour récupérer une catégorie par ID
    function getCategorieById($id_categorie, $conn) {
        try {
            $query = "SELECT * FROM categorie WHERE id_categorie = :id_categorie";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id_categorie', $id_categorie, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    // Fonction pour afficher une catégorie spécifique
    function showCategorie($id_categorie)
    {
        $sql = "SELECT * from categorie where id_categorie = $id_categorie";
        $db = getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $categorie = $query->fetch();
            return $categorie;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function listeCategoriesPaginated($start, $limit) {
        $sql = "SELECT * FROM categorie LIMIT :start, :limit";  
        $db = getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':start', (int)$start, PDO::PARAM_INT);
            $query->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            $query->execute();
            return $query->fetchAll();
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    
    public function countCategories() {
        $sql = "SELECT COUNT(*) as total FROM categorie";  
        $db = getConnexion();
        try {
            $query = $db->query($sql);
            $result = $query->fetch();
            return $result['total'];
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    
}
?>
