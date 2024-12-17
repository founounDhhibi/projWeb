<?php

class Event {
    private int $id_event;
    private string $nom_event;
    private $date_event;
    private string $description_event;
    private int $nbr_place;
    private string $image;

    private string $type;

    // Constructor
    public function __construct(
        string $nom_event,$date_event,string $description_event,int $nbr_place,string $image, string $type
    ) {
        $this->nom_event = $nom_event;
        $this->date_event = $date_event;
        $this->description_event = $description_event;
        $this->nbr_place = $nbr_place;
        $this->image = $image;
        $this->type = $type;
    }

    public function getIdEvent(): int
    {
        return $this->id_event;
    }

    public function setIdEvent(int $id_event): void
    {
        $this->id_event = $id_event;
    }

    public function getNomEvent(): string
    {
        return $this->nom_event;
    }

    public function setNomEvent(string $nom_event): void
    {
        $this->nom_event = $nom_event;
    }

    public function getDateEvent(): string
    {
        return $this->date_event;
    }

    public function setDateEvent(string $date_event): void
    {
        $this->date_event = $date_event;
    }

    public function getDescriptionEvent(): string
    {
        return $this->description_event;
    }

    public function setDescriptionEvent(string $description_event): void
    {
        $this->description_event = $description_event;
    }

    public function getNbrPlace(): int
    {
        return $this->nbr_place;
    }

    public function setNbrPlace(int $nbr_place): void
    {
        $this->nbr_place = $nbr_place;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

}

