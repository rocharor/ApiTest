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

    public function jsonSerialize()
    {
        $data = [];

        $getters = array_filter(get_class_methods($this), function ($method) {
            return 'get' === substr($method, 0, 3);
        });

        foreach ($getters as $method) {
            $key = lcfirst(str_replace('get', '', $method));
            $value = $this->$method();

            if (is_object($value) && method_exists($value, 'toArray')) {
                $value = $value->toArray();
            } elseif (is_object($value)) {
                $value = null;
            }

            $data[$key] = $value;
        }

        return $data;
    }
}
