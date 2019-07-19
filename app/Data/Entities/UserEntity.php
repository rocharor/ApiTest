<?php

namespace App\Data\Entities;

class UserEntity
{
    private $id;
    private $name;
    private $email;
    private $cnpj;
    private $password;

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getCnpj()
    {
        return $this->cnpj;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function setId($value): self
    {
        $this->id = $value;
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
    public function setCnpj($value): self
    {
        $this->cnpj = $value;
        return $this;
    }
    public function setPassword($value): self
    {
        $this->password = $value;
        return $this;
    }
}
