<?php

// namespace Tests\Unit\Service;

// use Tests\TestCase;

// use App\Data\Repositories\UserRepository;
// use App\Data\Models\User;
// use App\Data\Models\Address;
// use App\Data\Models\Contact;
// use App\Data\Entities\UserEntity;
// use App\Data\Entities\AddressEntity;
// use App\Data\Entities\ContactEntity;

// class UserRepositoryTest extends TestCase
// {
//     public function setUp(): void
//     {
//         parent::setUp();

//         $this->user = \Mockery::mock(User::class);
//         $this->address = \Mockery::mock(Address::class);
//         $this->contact = \Mockery::mock(Contact::class);

//         $this->userRepository = new UserRepository(
//             $this->user,
//             $this->address,
//             $this->contact
//         );

//         $this->userEntity = (new UserEntity)
//             ->setId(1)
//             ->setName('name')
//             ->setEmail('email')
//             ->setCnpj('cnpj')
//             ->setPassword('password');

//         $this->addressEntity = (new AddressEntity)
//             ->setId(1)
//             ->setAddress('address')
//             ->setCep(12345678);

//         $this->contactEntity = (new ContactEntity)
//             ->setId(1)
//             ->setPhone('123456789');
//     }

//     // public function testLogin()
//     // {
//     //     Auth::shouldReceive('attempt')
//     //         ->once()
//     //         ->andReturn(1);

//     //     $return = $this->userRepository->login([
//     //         'email' => 'test@test.com',
//     //         'password' => '123456'
//     //     ]);

//     //     dd($return);
//     // }
// }