<?php

class Categorie
{
    private int $id_categorie;
    private string $nom_categorie;
    private string $description_categorie;

    // Constructeur
    public function __construct(
        ?int $id_categorie,
        ?string $nom_categorie,
        ?string $description_categorie
    ) {
        $this->id_categorie = $id_categorie;
        $this->nom_categorie = $nom_categorie;
        $this->description_categorie = $description_categorie;
    }

    // Getters
    public function getIdCategorie(): int
    {
        return $this->id_categorie;
    }

    public function getNomCategorie(): string
    {
        return $this->nom_categorie;
    }

    public function getDescriptionCategorie(): string
    {
        return $this->description_categorie;
    }

    // Setters
    public function setIdCategorie(int $id_categorie): void
    {
        $this->id_categorie = $id_categorie;
    }

    public function setNomCategorie(string $nom_categorie): void
    {
        $this->nom_categorie = $nom_categorie;
    }

    public function setDescriptionCategorie(string $description_categorie): void
    {
        $this->description_categorie = $description_categorie;
    }
}
?>
