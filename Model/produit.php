<?php

class Produits
{
    private int $id_produit;
    private string $nom_produit;
    private string $description_produit;
    private float $prix_produit;
    private int $stock_produit;
    private DateTime $date_produit; // Utilisation de DateTime pour le type date
    private string $categorie_produit;
    private string $status_produit; // Enum : "available" ou "not available"
    private ?string $images_produit;

    public function __construct(
        ?int $id_produit,
        ?string $nom_produit,
        ?string $description_produit,
        ?float $prix_produit,
        ?int $stock_produit,
        $date_produit, // Accept both DateTime and string
        ?string $categorie_produit,
        ?string $status_produit,
        ?string $images_produit
    ) {
        $this->id_produit = $id_produit;
        $this->nom_produit = $nom_produit;
        $this->description_produit = $description_produit;
        $this->prix_produit = $prix_produit;
        $this->stock_produit = $stock_produit;
    
        // Convert date_produit to DateTime if it's a string
        if (is_string($date_produit)) {
            $this->date_produit = new DateTime($date_produit);
        } else {
            $this->date_produit = $date_produit;
        }
    
        $this->categorie_produit = $categorie_produit;
        $this->status_produit = $status_produit;
        $this->images_produit = $images_produit;
    }

    // Getters
    public function getIdProd(): int
    {
        return $this->id_produit;
    }

    public function getNomProd(): string
    {
        return $this->nom_produit;
    }

    public function getDescriptionProd(): string
    {
        return $this->description_produit;
    }

    public function getPrixProd(): float
    {
        return $this->prix_produit;
    }

    public function getStockProd(): int
    {
        return $this->stock_produit;
    }

    public function getDateProd(): string
    {
        return $this->date_produit ? $this->date_produit->format('Y-m-d') : '';
    }
    

    public function getCategorieProd(): string
    {
        return $this->categorie_produit;
    }

    public function getStatusProd(): string
    {
        return $this->status_produit;
    }

    public function getImageProd(): string
    {
        return $this->images_produit;
    }

    // Setters
    public function setNomProd(string $nom_produit): void
    {
        $this->nom_produit = $nom_produit;
    }

    public function setDescriptionProd(string $description_produit): void
    {
        $this->description_produit = $description_produit;
    }

    public function setPrixProd(float $prix_produit): void
    {
        $this->prix_produit = $prix_produit;
    }

    public function setStockProd(int $stock_produit): void
    {
        $this->stock_produit = $stock_produit;
    }

    public function setDateProd(string $date_produit): void
    {
        $this->date_produit = $date_produit;
    }

    public function setCategorieProd(string $categorie_produit): void
    {
        $this->categorie_produit = $categorie_produit;
    }

    public function setStatusProd(string $status_produit): void
    {
        $this->status_produit = $status_produit;
    }

    public function setImageProd(string $images_produit): void
    {
        $this->images_produit = $images_produit;
    }
}
