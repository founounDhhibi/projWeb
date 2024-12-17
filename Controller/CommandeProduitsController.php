<?php
include(__DIR__ . '/../Model/commandePro.php');
class CommandeProduitsController {
    public function addProduitCommande($produitCommande){
        $sql = "INSERT INTO commande_produits (id_commande, id_produit, quantite_commande_produit) 
                VALUES (:id_commande, :id_produit, :quantite_commande_produit)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_commande' => $produitCommande->getIdCommande(),
                'id_produit' => $produitCommande->getIdProduit(),
                'quantite_commande_produit' => $produitCommande->getQuantiteCommandeProduit()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    public function updateQuantity($id_cp, $id_prod, $quantity){
        $sql = "UPDATE commande_produits SET quantite_commande_produit = :quantity 
                         WHERE id_commande = :id_commande AND id_produit = :id_produit";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try{
            $query->execute([
                'id_commande' => $id_cp,
                'quantity' => $quantity,
                'id_produit' => $id_prod
            ]);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function deleteProduitCommande($id_commande, $id_produit){
        $sql = "DELETE FROM commande_produits WHERE id_commande = :id_commande AND id_produit = :id_produit";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try{
            $query->execute([
                'id_commande' => $id_commande,
                'id_produit' => $id_produit
            ]);
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function getProduitCommande($id_commande, $id_produit){
        $sql = "SELECT * FROM commande_produits WHERE id_commande = :id_commande AND id_produit = :id_produit";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try{
            $query->bindValue('id_commande', $id_commande);
            $query->bindValue('id_produit', $id_produit);
            $query->execute();
            return $query->fetch();
        }catch (Exception $e){
            die($e->getMessage());
        }
    }
}
?>
