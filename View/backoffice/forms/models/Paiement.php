<?php

class Paiement
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Liste tous les paiements
    public function getAllPaiements()
    {
        $stmt = $this->db->prepare("SELECT * FROM paiement");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère un paiement par ID
    public function getPaiementById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM paiement WHERE id_paiement = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajoute un nouveau paiement
    public function createPaiement($commande_id, $montant, $date, $mode, $statut)
    {
        $stmt = $this->db->prepare("INSERT INTO paiement (id_commande, montant_paiement, date_paiement, mode_paiement, statut_paiement) 
                                    VALUES (:commande_id, :montant, :date, :mode, :statut)");
        $stmt->bindParam(':commande_id', $commande_id);
        $stmt->bindParam(':montant', $montant);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':mode', $mode);
        $stmt->bindParam(':statut', $statut);
        return $stmt->execute();
    }

    // Met à jour un paiement existant
    public function updatePaiement($id, $commande_id, $montant, $date, $mode, $statut)
    {
        $stmt = $this->db->prepare("UPDATE paiement 
                                    SET id_commande = :commande_id, montant_paiement = :montant, date_paiement = :date, 
                                        mode_paiement = :mode, statut_paiement = :statut 
                                    WHERE id_paiement = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':commande_id', $commande_id);
        $stmt->bindParam(':montant', $montant);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':mode', $mode);
        $stmt->bindParam(':statut', $statut);
        return $stmt->execute();
    }

    // Supprime un paiement
    public function deletePaiement($id)
    {
        $stmt = $this->db->prepare("DELETE FROM paiement WHERE id_paiement = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
