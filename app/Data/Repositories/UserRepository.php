<?php

namespace App\Data\Repositories;

use App\Data\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Data\Entities\UserEntity;

class UserRepository
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
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

    public function store(UserEntity $userEntity): ?string
    {
        $result = $this->model->create([
            'name' => $userEntity->getName(),
            'email' => $userEntity->getEmail(),
            'cnpj' => $userEntity->getCnpj(),
            'address' => $userEntity->getAddress(),
            'cep' => $userEntity->getCep(),
            'phone' => $userEntity->getPhone(),
            'password' => bcrypt($userEntity->getPassword())
        ]);

        if (!is_null($result)) {
            $token =  $result->createToken($result->name)->accessToken;

            return $token;
        }

        return null;
    }
}
