<?php

namespace App\Data\Services;

use App\Data\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Exceptions\DefaultException;
use App\Data\Entities\UserEntity;
use App\Data\Entities\AddressEntity;
use App\Data\Entities\ContactEntity;

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
                'name' => 'required|string',
                'email' => 'required|email',
                'cnpj' => 'required',
                'address' => 'required|string',
                'cep' => 'required',
                'phone' => 'required',
                'password' => 'required|string',
                'confirm_password' => 'required|same:password',
            ])->validate();

            $userEntity = (new UserEntity)
                ->setName($params['name'])
                ->setEmail($params['email'])
                ->setCnpj($params['cnpj'])
                ->setPassword(bcrypt($params['password']));

            $addressEntity = (new AddressEntity)
                ->setAddress($params['address'])
                ->setCep($params['cep']);

            $contactEntity = (new ContactEntity)
                ->setPhone($params['phone']);


            $token = $this->repository->store($userEntity, $addressEntity, $contactEntity);

            if (!is_null($token)) {
                return $token;
            }

            throw new DefaultException(__('Error Create'));
        } catch(ValidationException $e) {
            throw new DefaultException($e->getMessage(), $e->errors());
        }
    }
}
