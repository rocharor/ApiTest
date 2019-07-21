<?php

namespace App\Data\Entities;

class AddressEntity
{
    private $id;
    private $address;
    private $cep;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getAddress(): ?string
    {
        return $this->address;
    }
    public function getCep(): ?int
    {
        return $this->cep;
    }

    public function setId($value): self
    {
        $this->id = $value;
        return $this;
    }
    public function setAddress($value): self
    {
        $this->address = $value;
        return $this;
    }
    public function setCep($value): self
    {
        $this->cep = $value;
        return $this;
    }
}
