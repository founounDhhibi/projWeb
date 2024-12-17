<?php
require_once  __DIR__ . '/../config.php';
include(__DIR__ . '/../Model/Paiement.php');

class PaiementController
{
    // Lister tous les paiements
    public function listPaiements()
    {
        $sql = "SELECT * FROM paiement";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Supprimer un paiement
    public function deletePaiement($id_paiement)
    {
        $sql = "DELETE FROM paiement WHERE id_paiement = :id_paiement";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_paiement', $id_paiement);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // Ajouter un paiement
    public function addPaiement($id_commande, $montant, $mode, $statut,$remise)
    {
        $sql = "INSERT INTO paiement (id_commande, montant_paiement, mode_paiement, statut_paiement, remise) 
                VALUES (:id_commande, :montant_paiement, :mode_paiement, :statut_paiement, :remise)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_commande' => $id_commande,
                'montant_paiement' => $montant,
                'mode_paiement' => $mode,
                'statut_paiement' => $statut,
                'remise' => $remise
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    // Mettre à jour un paiement
    public function updatePaiement($paiement, $id_paiement)
    {
        $sql = "UPDATE paiement SET 
                    id_commande = :id_commande,
                    montant_paiement = :montant_paiement,
                    date_paiement = :date_paiement,
                    mode_paiement = :mode_paiement,
                    statut_paiement = :statut_paiement
                WHERE id_paiement = :id_paiement";
        $db = config::getConnexion();

        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_paiement' => $id_paiement,
                'id_commande' => $paiement->getIdCommande(),
                'montant_paiement' => $paiement->getMontantPaiement(),
                'date_paiement' => $paiement->getDatePaiement()->format('Y-m-d'),
                'mode_paiement' => $paiement->getModePaiement(),
                'statut_paiement' => $paiement->getStatutPaiement()
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // Afficher un paiement spécifique
    public function showPaiement($id_paiement)
    {
        $sql = "SELECT * FROM paiement WHERE id_paiement = :id_paiement";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id_paiement', $id_paiement);
            $query->execute();

            $paiement = $query->fetch();
            return $paiement;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function accepterPaiement($id_paiement) {
        $sql = "UPDATE paiement SET statut_paiement = :statut_paiement WHERE id_paiement = :id_paiement";
        $db = config::getConnexion();
        try{
            $query = $db->prepare($sql);
            $query->execute([
                'id_paiement' => $id_paiement,
                'statut_paiement' => 'Accepter'
            ]);
        }catch (Exception $e){
            die($e->getMessage());
        }
    }

    public function getPaiement($id_paiement){
            $sql = "SELECT * FROM paiement WHERE id_paiement = :id_paiement";
            $db = config::getConnexion();
            $req = $db->prepare($sql);
            try {
                $req->bindValue('id_paiement', $id_paiement);
                $req->execute();
                $paiement = $req->fetch();
                return $paiement;
            } catch (Exception $e) {
                die('Error: ' . $e->getMessage());
            }
    }
}
?>
