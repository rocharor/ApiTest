<?php

namespace App\Data\Entities;

use JsonSerializable;

class ProviderEntity implements JsonSerializable
{
    private $id;
    private $userId;
    private $name;
    private $email;
    private $monthlyPayment;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getUserId(): ?int
    {
        return $this->userId;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function getMonthlyPayment(): ?float
    {
        return $this->monthlyPayment;
    }

    public function setId($value): self
    {
        $this->id = $value;
        return $this;
    }
    public function setUserId($value): self
    {
        $this->userId = $value;
        return $this;
    }
    public function setName($value): self
    {
        $this->name = $value;
        return $this;
    }
    public function setEmail($value): self
    {
        $this->email = $value;
        return $this;
    }
    public function setMonthlyPayment($value): self
    {
        $this->monthlyPayment = $value;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'monthlyPayment' => $this->getMonthlyPayment(),
        ];
    }
}
