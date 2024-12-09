<?php

class Commande
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;
    }

    // Liste toutes les commandes
    public function getAllCommandes()
    {
        $stmt = $this->db->prepare("SELECT * FROM commande");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupère une commande par ID
    public function getCommandeById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM commande WHERE id_commande = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ajoute une nouvelle commande
    public function createCommande($date, $statut, $montant)
    {
        $stmt = $this->db->prepare("INSERT INTO commande (date_commande, statut_commande, montant_commande) 
                                    VALUES (:date, :statut, :montant)");
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':statut', $statut);
        $stmt->bindParam(':montant', $montant);
        return $stmt->execute();
    }

    // Met à jour une commande existante
    public function updateCommande($id, $date, $statut, $montant)
    {
        $stmt = $this->db->prepare("UPDATE commande 
                                     SET date_commande = :date, statut_commande = :statut, montant_commande = :montant 
                                   WHERE id_commande = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':statut', $statut);
        $stmt->bindParam(':montant', $montant);
        return $stmt->execute();
    }

    // Supprime une commande
    public function deleteCommande($id)
    {
        $stmt = $this->db->prepare("DELETE FROM commande WHERE id_commande = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
