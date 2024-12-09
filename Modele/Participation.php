<?php

class Participation
{
    private int $id_event;
    private int $id_user;
    private $date_participation;

    public function __construct(
        int $id_event, int $id_user
    ) {
        $this->id_event = $id_event;
        $this->id_user = $id_user;
    }

    public function getIdEvent(): int
    {
        return $this->id_event;
    }

    public function setIdEvent(int $id_event): void
    {
        $this->id_event = $id_event;
    }

    public function getIdUser(): int
    {
        return $this->id_user;
    }

    public function setIdUser(int $id_user): void
    {
        $this->id_user = $id_user;
    }

    public function getDateParticipation(): int
    {
        return $this->date_participation;
    }

    public function setDateParticipation(int $date_participation): void
    {
        $this->date_participation = $date_participation;
    }
}
