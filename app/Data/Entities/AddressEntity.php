<?php

namespace App\Data\Entities;

class AddressEntity
{
    private $id;
    private $address;
    private $cep;

    public function getId()
    {
        return $this->id;
    }
    public function getAddress()
    {
        return $this->address;
    }
    public function getCep()
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
