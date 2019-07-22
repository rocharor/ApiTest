<?php

namespace App\Data\Services;

use App\Data\Repositories\ProviderRepository;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Data\Entities\ProviderEntity;
use App\Exceptions\DefaultException;
use App\Events\NewProvider;
use App\Data\Utils\CryptCustom;

class ProviderService
{
    private $repository;

    public function __construct(ProviderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): ?array
    {
        return $this->repository->findAll();
    }

    public function totalMonthlyPayment(): string
    {
        $response = $this->repository->sumTotalMonthlyPayment();

        $response = __('coin') . number_format($response, 2, ',', '.');

        return $response;
    }

    public function activeProvider(string $token): int
    {
        $providerId = CryptCustom::decryptCustom($token);

        return $this->repository->activeProvider($providerId);
    }

    public function store(array $params)
    {
        try {
            Validator::make($params, [
                'name' => 'required|string',
                'email' => 'required|email|unique:providers',
                'monthlyPayment' => 'required',
            ])->validate();

            $providerEntity = (new ProviderEntity)
                ->setName($params['name'])
                ->setEmail($params['email'])
                ->setMonthlyPayment($params['monthlyPayment']);

            $response = $this->repository->store($providerEntity);

            if ($response->getId() > 0) {
                event(new NewProvider($response));
                return $response;
            }

            throw new DefaultException(__('Error create'));
        } catch(ValidationException $e) {
            throw new DefaultException($e->getMessage(), $e->errors());
        }
    }

    public function delete(int $id)
    {
        $response = $this->repository->delete($id);

        if ($response) {
            return true;
        }

        throw new DefaultException(__('Error delete'));
    }
}
