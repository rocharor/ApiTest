<?php

namespace App\Data\Entities;

class ProviderEntity
{
    private $id;
    private $userId;
    private $name;
    private $email;
    private $monthlyPayment;

    public function getId()
    {
        return $this->id;
    }
    public function getUserId()
    {
        return $this->userId;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getMonthlyPayment()
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
}
