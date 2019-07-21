<?php

namespace Tests\Unit\Entity;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Data\Entities\AddressEntity;

class AddressEntityTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $this->addressEntity = (new AddressEntity)
            ->setId(1)
            ->setAddress('address')
            ->setCep(12345678);
    }

    public function testGet()
    {
        $this->assertEquals(1, $this->addressEntity->getId());
        $this->assertEquals('address', $this->addressEntity->getAddress());
        $this->assertEquals(12345678, $this->addressEntity->getCep());
    }
}
