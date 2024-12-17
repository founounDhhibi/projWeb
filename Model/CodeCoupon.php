<?php

class CodeCoupon
{
    private int $id_code;
    private string $code;

    private float $remise;
    private $date_code;
    private bool $is_used;

    public function __construct(int $id_code, string $code, float $remise)
    {
        $this->id_code = $id_code;
        $this->code = $code;
        $this->remise = $remise;
    }
    public function getIdCode(): int
    {
        return $this->id_code;
    }
    public function setIdCode(int $id_code): void
    {
        $this->id_code = $id_code;
    }
    public function getDateCode()
    {
        return $this->date_code;
    }
    public function setDateCode($date_code): void
    {
        $this->date_code = $date_code;
    }
    public function isIsUsed(): bool
    {
        return $this->is_used;
    }
    public function setIsUsed(bool $is_used): void
    {
        $this->is_used = $is_used;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): void
    {
        $this->code = $code;
    }

    public function getRemise(): float
    {
        return $this->remise;
    }

    public function setRemise(float $remise): void
    {
        $this->remise = $remise;
    }

}