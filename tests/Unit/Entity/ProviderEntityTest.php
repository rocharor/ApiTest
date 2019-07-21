<?php

namespace Tests\Unit\Entity;

use Tests\TestCase;
use App\Data\Entities\ProviderEntity;

class ProviderEntityTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $this->providerEntity = (new ProviderEntity)
            ->setId(1)
            ->setUserId(2)
            ->setName('name')
            ->setEmail('email')
            ->setMonthlyPayment(200);
    }

    public function testGet()
    {
        $this->assertEquals(1, $this->providerEntity->getId());
        $this->assertEquals(2, $this->providerEntity->getUserId());
        $this->assertEquals('name', $this->providerEntity->getName());
        $this->assertEquals('email', $this->providerEntity->getEmail());
        $this->assertEquals(200, $this->providerEntity->getMonthlyPayment());
    }

    public function testJsonSerialize()
    {
        $this->assertEquals(
            $this->providerEntity->jsonSerialize(),
            [
                'id' => 1,
                'name' => 'name',
                'email' => 'email',
                'monthlyPayment' => 200,
            ]
        );
    }
}
