<?php

class Commande {
    private ?int $id_commande;
    private ?DateTime $date_commande;
    private ?string $statut_commande; // 'en attente', 'validée', 'annulée'
    private ?float $montant_commande;
    private ?int $id_user;

    // Constructor
    public function __construct(?string $statut_commande, ?float $montant_commande, ?int $id_user) {
        $this->statut_commande = $statut_commande;
        $this->montant_commande = $montant_commande;
        $this->id_user = $id_user;
    }

    // Getters and Setters
    public function getIdCommande(): ?int {
        return $this->id_commande;
    }

    public function setIdCommande(?int $id_commande): void {
        $this->id_commande = $id_commande;
    }

    public function getDateCommande(): ?DateTime {
        return $this->date_commande;
    }

    public function setDateCommande(?DateTime $date_commande): void {
        $this->date_commande = $date_commande;
    }

    public function getStatutCommande(): ?string {
        return $this->statut_commande;
    }

    public function setStatutCommande(?string $statut_commande): void {
        $this->statut_commande = $statut_commande;
    }

    public function getMontantCommande(): ?float {
        return $this->montant_commande;
    }

    public function setMontantCommande(?float $montant_commande): void {
        $this->montant_commande = $montant_commande;
    }

    public function getIdUser(): ?int {
        return $this->id_user;
    }
    public function setIdUser(?int $id_user): void {
        $this->id_user = $id_user;
    }
}


?>
