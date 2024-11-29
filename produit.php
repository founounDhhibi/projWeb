<?php

class Produits
{
    private int $id_prod;
    private string $nom_prod;
    private string $description_prod;
    private float $prix_prod;
    private int $stock_prod;
    private DateTime $date_prod; // Utilisation de DateTime pour le type date
    private string $categorie_prod;
    private string $status_prod; // Enum : "available" ou "not available"
    private string $image_prod;

    public function __construct(
        ?int $id_prod,
        ?string $nom_prod,
        ?string $description_prod,
        ?float $prix_prod,
        ?int $stock_prod,
        ?DateTime $date_prod,
        ?string $categorie_prod,
        ?string $status_prod,
        ? string $image_prod
    ) {
        $this->id_prod = $id_prod;
        $this->nom_prod = $nom_prod;
        $this->description_prod = $description_prod;
        $this->prix_prod = $prix_prod;
        $this->stock_prod = $stock_prod;
        $this->date_prod = $date_prod;
        $this->categorie_prod = $categorie_prod;
        $this->status_prod = $status_prod;
        $this->image_prod = $image_prod;
    }

    // Getters
    public function getIdProd(): int
    {
        return $this->id_prod;
    }

    public function getNomProd(): string
    {
        return $this->nom_prod;
    }

    public function getDescriptionProd(): string
    {
        return $this->description_prod;
    }

    public function getPrixProd(): float
    {
        return $this->prix_prod;
    }

    public function getStockProd(): int
    {
        return $this->stock_prod;
    }

    public function getDateProd(): string
    {
        return $this->date_prod;
    }

    public function getCategorieProd(): string
    {
        return $this->categorie_prod;
    }

    public function getStatusProd(): string
    {
        return $this->status_prod;
    }

    public function getImageProd(): string
    {
        return $this->image_prod;
    }

    // Setters
    public function setNomProd(string $nom_prod): void
    {
        $this->nom_prod = $nom_prod;
    }

    public function setDescriptionProd(string $description_prod): void
    {
        $this->description_prod = $description_prod;
    }

    public function setPrixProd(float $prix_prod): void
    {
        $this->prix_prod = $prix_prod;
    }

    public function setStockProd(int $stock_prod): void
    {
        $this->stock_prod = $stock_prod;
    }

    public function setDateProd(string $date_prod): void
    {
        $this->date_prod = $date_prod;
    }

    public function setCategorieProd(string $categorie_prod): void
    {
        $this->categorie_prod = $categorie_prod;
    }

    public function setStatusProd(string $status_prod): void
    {
        $this->status_prod = $status_prod;
    }

    public function setImageProd(string $image_prod): void
    {
        $this->image_prod = $image_prod;
    }
}
