<?php

namespace App\Data\Services;

use App\Data\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Exceptions\DefaultException;
use App\Data\Entities\UserEntity;

class UserService
{
    private $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function login(array $credentials)
    {
        try {
            Validator::make($credentials, [
                'email' => 'required|email',
                'password' => 'required',
            ])->validate();

            $response = $this->repository->login($credentials);

            if ($response) {
                return $response;
            }

            throw new DefaultException(__('Not Authorized'));
        } catch(ValidationException $e) {
            throw new DefaultException($e->getMessage(), $e->errors());
        }
    }

    public function store(array $params)
    {
        try {
            Validator::make($params, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'cnpj' => 'required|unique:users',
                'address' => 'required|string',
                'cep' => 'required',
                'phone' => 'required',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ])->validate();

            $userEntity = (new UserEntity)
                ->setName($params['name'])
                ->setEmail($params['email'])
                ->setCnpj($params['cnpj'])
                ->setAddress($params['address'])
                ->setCep($params['cep'])
                ->setPhone($params['phone'])
                ->setPassword(bcrypt($params['password']));


            $token = $this->repository->store($userEntity);

            if (!is_null($token)) {
                return $token;
            }

            throw new DefaultException(__('Error Create'));
        } catch(ValidationException $e) {
            throw new DefaultException($e->getMessage(), $e->errors());
        }
    }
}
