<?php

include(__DIR__ . '/../config.php');
include(__DIR__ . '/../model/produit.php');

class ProduitC
{
    public function listeProduits()
    {
        $db = getConnexion();  
        try {
            $liste = $db->query('SELECT * FROM produits');
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function addProduit($produit)
    {
        $db = getConnexion();  
        try {
            $req = $db->prepare('
                INSERT INTO produits (nom_prod, description_prod, prix_prod, stock_prod, date_prod, categorie_prod, status_prod, image_prod) 
                VALUES (:nom_prod, :description_prod, :prix_prod, :stock_prod, :date_prod, :categorie_prod, :status_prod, :image_prod)
            ');
            $req->execute([
                'nom_prod' => $produit->getNomProd(),
                'description_prod' => $produit->getDescriptionProd(),
                'prix_prod' => $produit->getPrixProd(),
                'stock_prod' => $produit->getStockProd(),
                'date_prod' => $produit->getDateProd(),
                'categorie_prod' => $produit->getCategorieProd(),
                'status_prod' => $produit->getStatusProd(),
                'image_prod' => $produit->getImageProd(),
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function deleteProduit($id_prod)
    {
        $db = getConnexion();  
        try {
            $req = $db->prepare('
                DELETE FROM produits WHERE id_prod = :id
            ');
            $req->execute([
                'id' => $id_prod,
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function updateProduit($id_prod, $produit)
    {
        $db = getConnexion();  
        try {
            $req = $db->prepare('
                UPDATE produits 
                SET 
                    nom_prod = :nom, 
                    description_prod = :description, 
                    prix_prod = :prix, 
                    stock_prod = :stock, 
                    date_prod = :date, 
                    categorie_prod = :categorie, 
                    status_prod = :status, 
                    image_prod = :image
                WHERE id_prod = :id
            ');
            $req->execute([
                'id' => $id_prod,
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
function getProduitById($id_prod, $conn) {
    try {
        $query = "SELECT * FROM produits WHERE id_prod = :id_prod";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_prod', $id_prod, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        return null;
    }
}


    
    function showProduit($id_produit)
    {
        $sql = "SELECT * from produits where id_prod = $id_produit";
        $db = getConnexion();
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
    
    public function countProduits() {
        $sql = "SELECT COUNT(*) as total FROM produits";
        $db = getConnexion();
        try {
            $query = $db->query($sql);
            $result = $query->fetch();
            return $result['total'];
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }
    public function getTop5RatedProducts() {
        $db = getConnexion();
    
        $sql = "
            SELECT 
                p.nom_prod,
                AVG(r.rating) AS avg_rating
            FROM produits p
            INNER JOIN ratings r ON p.id_prod = r.product_id
            GROUP BY p.id_prod
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
