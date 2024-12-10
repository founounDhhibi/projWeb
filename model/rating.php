<?php

class Rating
{
    private int $id_rate;
    private int $product_id;
    private int $user_id;
    private int $rating;
    private string $created_at;
    private string $titre;
    private string $description;

    // Constructeur
    public function __construct(
        ?int $id_rate,
        ?int $product_id,
        ?int $user_id,
        ?int $rating,
        ?string $created_at,
        ?string $titre,
        ?string $description
    ) {
        $this->id_rate = $id_rate;
        $this->product_id = $product_id;
        $this->user_id = $user_id;
        $this->rating = $rating;
        $this->created_at = $created_at;
        $this->titre = $titre;
        $this->description = $description;
    }

    // Getters
    public function getIdRate(): int
    {
        return $this->id_rate;
    }

    public function getProductId(): int
    {
        return $this->product_id;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    // Setters
    public function setProductId(int $product_id): void
    {
        $this->product_id = $product_id;
    }

    public function setUserId(int $user_id): void
    {
        $this->user_id = $user_id;
    }

    public function setRating(int $rating): void
    {
        $this->rating = $rating;
    }

    public function setTitre(string $titre): void
    {
        $this->titre = $titre;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }
}
?>
