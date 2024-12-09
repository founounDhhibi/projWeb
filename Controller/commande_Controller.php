<?php
require_once __DIR__ .'/../config.php';
include(__DIR__ . '/../Model/commande.php');



class CommandController
{
    // Lister toutes les commandes
    public function listCommandes()
    {
        $sql = "SELECT * FROM commande";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Supprimer une commande
    public function deleteCommande($id_commande)
    {
        $sql = "DELETE FROM commande WHERE id_commande = :id_commande";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_commande', $id_commande);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Ajouter une commande
    public function addCommande($commande)
    {
        $sql = "INSERT INTO commande (id_user, statut_commande, montant_commande) 
                VALUES (:id_user, :statut_commande, :montant_commande)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'statut_commande' => $commande->getStatutCommande(),
                'montant_commande' => $commande->getMontantCommande(),
                'id_user' => $commande->getIdUser()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Mettre à jour une commande
    public function updateCommande($commande, $id_commande)
    {
        $sql = "UPDATE commande SET 
                    date_commande = :date_commande,
                    statut_commande = :statut_commande,
                    montant_commande = :montant_commande
                WHERE id_commande = :id_commande";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_commande' => $id_commande,
                'date_commande' => $commande->getDateCommande()->format('Y-m-d'),
                'statut_commande' => $commande->getStatutCommande(),
                'montant_commande' => $commande->getMontantCommande()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Afficher une commande spécifique
    public function showCommande($id_commande)
    {
        $sql = "SELECT * FROM commande WHERE id_commande = :id_commande";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_commande', $id_commande);
            $query->execute();

            $commande = $query->fetch();
            return $commande;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    // dernier id commande par user
    public function getLastCommande($id_user){
        $sql = "SELECT * FROM commande WHERE id_user = :id_user AND statut_commande = :statut_commande";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try{
            $query->bindValue(':id_user', $id_user);
            $query->bindValue(':statut_commande', "Non confirmée");
            $query->execute();
            $commande = $query->fetch();
            return $commande;
        } catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function joinProduitCommande($id_commande){
        $sql = "SELECT * FROM commande_produits cp JOIN commande c on cp.id_commande = c.id_commande
         WHERE c.id_commande = :id_commande";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try{
            $query->bindValue(':id_commande', $id_commande);
            $query->execute();
            $commande = $query->fetchAll();
            return $commande;
        } catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function joinProduitCommandeByStatus($id_user){
        $sql = "SELECT * FROM commande_produits cp JOIN commande c on cp.id_commande = c.id_commande
         WHERE c.statut_commande = :statut AND c.id_user = :id_user";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try{
            $query->bindValue(':statut', "Non confirmée");
            $query->bindValue(':id_user', $id_user);
            $query->execute();
            $commande = $query->fetchAll();
            return $commande;
        } catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function updatePrice($id_commande, $new_price){
        $sql = "UPDATE commande SET 
                    montant_commande = :montant_commande
                WHERE id_commande = :id_commande";
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
            $query->execute([
                'montant_commande' => $new_price,
                'id_commande' => $id_commande
            ]);
        } catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function updateStatus($id_commande, $status){
        $sql = "UPDATE commande SET 
                    statut_commande = :statut_commande
                WHERE id_commande = :id_commande";
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
            $query->execute([
                'statut_commande' => $status,
                'id_commande' => $id_commande
            ]);
        } catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function joinPaiement($id_commande) {
        $sql = "SELECT * FROM commande c JOIN paiement p ON p.id_commande = c.id_commande
                WHERE c.id_commande = :id_commande";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try{
            $query->bindValue(':id_commande', $id_commande);
            $query->execute();
            return $query->fetch();
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function triMontantAsc(){
        $sql = "SELECT * FROM commande ORDER BY montant_commande ASC";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function triMontantDesc(){
        $sql = "SELECT * FROM commande ORDER BY montant_commande DESC";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function searchForCommande($keyword){
        $sql = "SELECT * FROM commande WHERE id_commande = :keyword OR id_user = :keyword";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try {
            $query->bindValue(':keyword', $keyword);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function joinProduitCommandePDF($id_commande){
        $sql = "SELECT * FROM commande_produits cp JOIN commande c on cp.id_commande = c.id_commande
                JOIN produits p ON cp.id_produit = p.id_produit WHERE c.id_commande = :id_commande";
        $db = config::getConnexion();
        $query = $db->prepare($sql);
        try{
            $query->bindValue(':id_commande', $id_commande);
            $query->execute();
            $commande = $query->fetchAll();
            return $commande;
        } catch (Exception $e){
            die($e->getMessage());
        }
    }
}
?>
