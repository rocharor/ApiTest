<?php

namespace Tests\Unit\Service;

use Tests\TestCase;
use App\Data\Repositories\ProviderRepository;
use App\Data\Services\ProviderService;
use App\Data\Entities\ProviderEntity;
use Illuminate\Support\Facades\Event;
use App\Data\Utils\CryptCustom;

class ProviderServiceTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Event::fake();

        $this->providerRepository = \Mockery::mock(ProviderRepository::class);

        $this->providerService = new ProviderService(
            $this->providerRepository
        );

        $this->providerEntity = (new ProviderEntity)
            ->setId(1)
            ->setUserId(2)
            ->setName('name')
            ->setEmail('email')
            ->setMonthlyPayment(200);
    }

    public function testGetAll()
    {
        $this->providerRepository->shouldReceive('findAll')
            ->once()
            ->andReturn([$this->providerEntity]);

        $return = $this->providerService->getAll();

        $providerEntity = reset($return);

        $this->assertInstanceOf(ProviderEntity::class, $providerEntity);
        $this->assertEquals(1, $providerEntity->getId());
        $this->assertEquals(2, $providerEntity->getUserId());
        $this->assertEquals('name', $providerEntity->getName());
        $this->assertEquals('email', $providerEntity->getEmail());
        $this->assertEquals(200, $providerEntity->getMonthlyPayment());
    }

    public function testTotalMonthlyPayment()
    {
        $this->providerRepository->shouldReceive('sumTotalMonthlyPayment')
            ->once()
            ->andReturn(200);

        $return = $this->providerService->totalMonthlyPayment();

        $this->assertEquals('R$ 200,00', $return);
    }

    public function testActiveProvider()
    {
        $this->providerRepository->shouldReceive('activeProvider')
            ->once()
            ->andReturn(1);

        $token = CryptCustom::cryptCustom(123);

        $return = $this->providerService->activeProvider($token);

        $this->assertEquals(1, $return);
    }

    public function testStore()
    {
        $this->providerRepository->shouldReceive('store')
            ->once()
            ->andReturn($this->providerEntity);

        $return = $this->providerService->store([
            'name' => 'name',
            'email' => 'test123@gmail.com',
            'monthlyPayment' => 200,
        ]);

        $this->assertInstanceOf(ProviderEntity::class, $return);
        $this->assertEquals(1, $return->getId());
        $this->assertEquals(2, $return->getUserId());
        $this->assertEquals('name', $return->getName());
        $this->assertEquals('email', $return->getEmail());
        $this->assertEquals(200, $return->getMonthlyPayment());
    }

    /**
     * @expectedException App\Exceptions\DefaultException
     */
    public function testStoreError()
    {
        $this->providerEntity->setId(null);
        $this->providerRepository->shouldReceive('store')
            ->once()
            ->andReturn($this->providerEntity);

        $this->providerService->store([
            'name' => 'name',
            'email' => 'test123@gmail.com',
            'monthlyPayment' => 200,
        ]);
    }

    /**
     * @expectedException App\Exceptions\DefaultException
     */
    public function testStoreErrorParameter()
    {
        $this->providerService->store([
            // 'name' => 'name',
            'email' => 'test123@gmail.com',
            'monthlyPayment' => 200,
        ]);
    }

    public function testDelete()
    {
        $this->providerRepository->shouldReceive('delete')
            ->once()
            ->andReturn(1);

        $return = $this->providerService->delete(1);

        $this->assertTrue($return);
    }

    /**
     * @expectedException App\Exceptions\DefaultException
     */
    public function testDeleteError()
    {
        $this->providerRepository->shouldReceive('delete')
            ->once()
            ->andReturn(0);

        $this->providerService->delete(1);
    }

    // public function testLoginNotAuthorized()
    // {
    //     $this->userRepository->shouldReceive('login')
    //         ->once()
    //         ->andReturn(null);

    //     $this->userService->login([
    //         'email' => 'test@test.com',
    //         'password' => '123456'
    //     ]);
    // }

    // /**
    //  * @expectedException App\Exceptions\DefaultException
    //  */
    // public function testLoginErroParameter()
    // {
    //     $this->userService->login([
    //         // 'email' => 'test@test.com',
    //         'password' => '123456'
    //     ]);
    // }


    // public function testStore()
    // {
    //     $this->userRepository->shouldReceive('store')
    //         ->once()
    //         ->andReturn('token-123');

    //     $return = $this->userService->store([
    //         'name' => 'name',
    //         'email' => 'test@test.com',
    //         'cnpj' => 'cnpj',
    //         'address' => 'address',
    //         'cep' => 'cep',
    //         'phone' => 'phone',
    //         'password' => 'password',
    //         'confirm_password' => 'password',
    //     ]);

    //     $return = $this->assertEquals('token-123', $return);
    // }

    // /**
    //  * @expectedException App\Exceptions\DefaultException
    //  */
    // public function testStoreError()
    // {
    //     $this->userRepository->shouldReceive('store')
    //         ->once()
    //         ->andReturn(null);

    //     $return = $this->userService->store([
    //         'name' => 'name',
    //         'email' => 'test@test.com',
    //         'cnpj' => 'cnpj',
    //         'address' => 'address',
    //         'cep' => 'cep',
    //         'phone' => 'phone',
    //         'password' => 'password',
    //         'confirm_password' => 'password',
    //     ]);
    // }

    // /**
    //  * @expectedException App\Exceptions\DefaultException
    //  */
    // public function testStoreErrorParameter()
    // {
    //     $this->userService->store([
    //         // 'name' => 'name',
    //         'email' => 'test@test.com',
    //         'cnpj' => 'cnpj',
    //         'address' => 'address',
    //         'cep' => 'cep',
    //         'phone' => 'phone',
    //         'password' => 'password',
    //         'confirm_password' => 'password',
    //     ]);
    // }
}
