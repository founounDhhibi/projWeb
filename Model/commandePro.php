<?php

class CommandeProduits {
    private ?int $id_commande;
    private ?int $id_produit;
    private ?int $quantite_commande_produit;

    // Constructor
    public function __construct(
        ?int $id_commande,
        ?int $id_produit,
        ?int $quantite_commande_produit
    ) {
        $this->id_commande = $id_commande;
        $this->id_produit = $id_produit;
        $this->quantite_commande_produit = $quantite_commande_produit;
    }

    // Getters and Setters
    public function getIdCommande(): ?int {
        return $this->id_commande;
    }

    public function setIdCommande(?int $id_commande): void {
        $this->id_commande = $id_commande;
    }

    public function getIdProduit(): ?int {
        return $this->id_produit;
    }

    public function setIdProduit(?int $id_produit): void {
        $this->id_produit = $id_produit;
    }

    public function getQuantiteCommandeProduit(): ?int {
        return $this->quantite_commande_produit;
    }

    public function setQuantiteCommandeProduit(?int $quantite_commande_produit): void {
        $this->quantite_commande_produit = $quantite_commande_produit;
    }
}
?>
