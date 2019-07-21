<?php

namespace Tests\Unit\Service;

use Tests\TestCase;
use App\Data\Repositories\UserRepository;
use App\Data\Services\UserService;

class UserServiceTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $this->userRepository = \Mockery::mock(UserRepository::class);

        $this->userService = new UserService(
            $this->userRepository
        );
    }

    public function testLogin()
    {
        $this->userRepository->shouldReceive('login')
            ->once()
            ->andReturn('token-123');

        $return = $this->userService->login([
            'email' => 'test@test.com',
            'password' => '123456'
        ]);

        $this->assertEquals('token-123', $return);
    }

    /**
     * @expectedException App\Exceptions\DefaultException
     */
    public function testLoginNotAuthorized()
    {
        $this->userRepository->shouldReceive('login')
            ->once()
            ->andReturn(null);

        $this->userService->login([
            'email' => 'test@test.com',
            'password' => '123456'
        ]);
    }

    /**
     * @expectedException App\Exceptions\DefaultException
     */
    public function testLoginErroParameter()
    {
        $this->userService->login([
            // 'email' => 'test@test.com',
            'password' => '123456'
        ]);
    }


    public function testStore()
    {
        $this->userRepository->shouldReceive('store')
            ->once()
            ->andReturn('token-123');

        $return = $this->userService->store([
            'name' => 'name',
            'email' => 'test@test.com',
            'cnpj' => 'cnpj',
            'address' => 'address',
            'cep' => 'cep',
            'phone' => 'phone',
            'password' => 'password',
            'confirm_password' => 'password',
        ]);

        $return = $this->assertEquals('token-123', $return);
    }

    /**
     * @expectedException App\Exceptions\DefaultException
     */
    public function testStoreError()
    {
        $this->userRepository->shouldReceive('store')
            ->once()
            ->andReturn(null);

        $return = $this->userService->store([
            'name' => 'name',
            'email' => 'test@test.com',
            'cnpj' => 'cnpj',
            'address' => 'address',
            'cep' => 'cep',
            'phone' => 'phone',
            'password' => 'password',
            'confirm_password' => 'password',
        ]);
    }

    /**
     * @expectedException App\Exceptions\DefaultException
     */
    public function testStoreErrorParameter()
    {
        $this->userService->store([
            // 'name' => 'name',
            'email' => 'test@test.com',
            'cnpj' => 'cnpj',
            'address' => 'address',
            'cep' => 'cep',
            'phone' => 'phone',
            'password' => 'password',
            'confirm_password' => 'password',
        ]);
    }
}
