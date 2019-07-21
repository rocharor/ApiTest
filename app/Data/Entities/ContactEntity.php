<?php

namespace App\Data\Entities;

class ContactEntity
{
    private $id;
    private $phone;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setId($value): self
    {
        $this->id = $value;
        return $this;
    }
    public function setPhone($value): self
    {
        $this->phone = $value;
        return $this;
    }
}
