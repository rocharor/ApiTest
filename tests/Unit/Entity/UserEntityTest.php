<?php

namespace Tests\Unit\Entity;

use Tests\TestCase;
use App\Data\Entities\UserEntity;

class UserEntityTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $this->userEntity = (new UserEntity)
            ->setId(1)
            ->setName('name')
            ->setEmail('email')
            ->setCnpj('cnpj')
            ->setPassword('password');
    }

    public function testGet()
    {
        $this->assertEquals(1, $this->userEntity->getId());
        $this->assertEquals('name', $this->userEntity->getName());
        $this->assertEquals('email', $this->userEntity->getEmail());
        $this->assertEquals('cnpj', $this->userEntity->getCnpj());
        $this->assertEquals('password', $this->userEntity->getPassword());
    }
}
