<?php

namespace Tests\Unit\Entity;

use Tests\TestCase;
use App\Data\Entities\ContactEntity;

class ContactEntityTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $this->contactEntity = (new ContactEntity)
            ->setId(1)
            ->setPhone('123456789');
    }

    public function testGet()
    {
        $this->assertEquals(1, $this->contactEntity->getId());
        $this->assertEquals('123456789', $this->contactEntity->getPhone());
    }
}
