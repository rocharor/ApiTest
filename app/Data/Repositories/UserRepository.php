<?php

namespace App\Data\Repositories;

use App\Data\Models\User;
use App\Data\Models\Address;
use App\Data\Models\Contact;
use Illuminate\Support\Facades\Auth;
use App\Data\Entities\UserEntity;
use App\Data\Entities\AddressEntity;
use App\Data\Entities\ContactEntity;

class UserRepository
{
    private $model;
    private $addressModel;
    private $contactModel;

    public function __construct(User $model, Address $address, Contact $contact)
    {
        $this->model = $model;
        $this->addressModel = $address;
        $this->contactModel = $contact;
    }

    public function login(array $credentials): ?string
    {
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token =  $user->createToken($user->name)->accessToken;

            return $token;
        }

        return null;
    }

    public function store(
        UserEntity $userEntity,
        AddressEntity $addressEntity,
        ContactEntity $contactEntity
    ): ?string {

        $result = $this->model->create([
            'name' => $userEntity->getName(),
            'email' => $userEntity->getEmail(),
            'cnpj' => $userEntity->getCnpj(),
            'password' => $userEntity->getPassword()
        ]);

        if (!is_null($result)) {
            $this->addressModel->create([
                'user_id' => $result->id,
                'cep' => $addressEntity->getCep(),
                'address' => $addressEntity->getAddress(),
            ]);

            $this->contactModel->create([
                'user_id' => $result->id,
                'phone' => $contactEntity->getPhone(),
            ]);

            $token =  $result->createToken($result->name)->accessToken;

            return $token;
        }

        return null;
    }
}
