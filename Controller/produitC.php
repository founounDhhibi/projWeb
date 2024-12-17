<?php

include(__DIR__ . '/../config.php');
include(__DIR__ . '/../model/produit.php');

class ProduitC
{
    public function listeProduits()
    {
        $db = config::getConnexion();  
        try {
            $liste = $db->query('SELECT * FROM produits');
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function addProduit($produit)
    {
        $db = config::getConnexion();  
        try {
            $req = $db->prepare('
                INSERT INTO produits (nom_produit, description_produit, prix_produit, stock_produit, date_produit, categorie_produit, status_produit, images_produit) 
                VALUES (:nom_produit, :description_produit, :prix_produit, :stock_produit, :date_produit, :categorie_produit, :status_produit, :images_produit)
            ');
            $req->execute([
                'nom_produit' => $produit->getNomProd(),
                'description_produit' => $produit->getDescriptionProd(),
                'prix_produit' => $produit->getPrixProd(),
                'stock_produit' => $produit->getStockProd(),
                'date_produit' => $produit->getDateProd(),
                'categorie_produit' => $produit->getCategorieProd(),
                'status_produit' => $produit->getStatusProd(),
                'images_produit' => $produit->getImageProd(),
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function deleteProduit($id_produit)
    {
        $db = config::getConnexion();  
        try {
            // Étape 1 : Supprimer les évaluations liées dans la table 'ratings'
            $req1 = $db->prepare('DELETE FROM ratings WHERE product_id = :id');
            $req1->execute([
                'id' => $id_produit,
            ]);
    
            // Étape 2 : Supprimer le produit dans la table 'produits'
            $req2 = $db->prepare('DELETE FROM produits WHERE id_produit = :id');
            $req2->execute([
                'id' => $id_produit,
            ]);
    
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    

    public function updateProduit($id_produit, $produit)
    {
        $db = config::getConnexion();  
        try {
            $req = $db->prepare('
                UPDATE produits 
                SET 
                    nom_produit = :nom, 
                    description_produit = :description, 
                    prix_produit = :prix, 
                    stock_produit = :stock, 
                    date_produit = :date, 
                    categorie_produit = :categorie, 
                    status_produit = :status, 
                    images_produit = :image
                WHERE id_produit = :id
            ');
            $req->execute([
                'id' => $id_produit,
                'nom' => $produit->getNomProd(),
                'description' => $produit->getDescriptionProd(),
                'prix' => $produit->getPrixProd(),
                'stock' => $produit->getStockProd(),
                'date' => $produit->getDateProd(),
                'categorie' => $produit->getCategorieProd(),
                'status' => $produit->getStatusProd(),
                'image' => $produit->getImageProd(),
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    //hethi lel update 
 // Fonction pour récupérer le produit par ID
function getProduitById($id_produit, $conn) {
    try {
        $query = "SELECT * FROM produits WHERE id_produit = :id_produit";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_produit', $id_produit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return null;
    }
}


    
    function showProduit($id_produituit)
    {
        $sql = "SELECT * from produits where id_produit = $id_produituit";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $offer = $query->fetch();
            return $offer;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function listeProduitsPaginated($start, $limit) {
        $sql = "SELECT * FROM produits LIMIT :start, :limit";
        $db = config::getConnexion();
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
    
    public function countProduits() {
        $sql = "SELECT COUNT(*) as total FROM produits";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            $result = $query->fetch();
            return $result['total'];
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    public function getTop5RatedProducts() {
        $db = config::getConnexion();
    
        $sql = "
            SELECT 
                p.nom_produit,
                AVG(r.rating) AS avg_rating
            FROM produits p
            INNER JOIN ratings r ON p.id_produit = r.product_id
            GROUP BY p.id_produit
            ORDER BY avg_rating DESC
            LIMIT 5
        ";
    
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    
    
}

?>
