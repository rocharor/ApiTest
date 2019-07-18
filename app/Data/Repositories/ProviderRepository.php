<?php

namespace App\Data\Repositories;

use App\Data\Models\Provider;
use App\Data\Entities\ProviderEntity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ProviderRepository
{
    private $model;
    private $seconds = 60;

    public function __construct(Provider $model)
    {
        $this->model = $model;
    }

    public function findAll(): ?array
    {
        $key = 'providers-' . Auth::user()->id;
        $result = Cache::remember($key, $this->seconds, function () {
            return $this->model
                ->where('user_id', Auth::user()->id)
                ->get();
        });

        $response = null;
        foreach ($result as $value) {
            $response[] = (new ProviderEntity)
                ->setId($value->id)
                ->setUserId($value->user_id)
                ->setName($value->name)
                ->setEmail($value->email)
                ->setMonthlyPayment($value->monthly_payment);
        }

        return $response;
    }

    public function sumTotalMonthlyPayment(): float
    {
        $key = 'payment-' . Auth::user()->id;
        $response = Cache::remember($key, $this->seconds, function () {
            return $this->model
                ->where('user_id', Auth::user()->id)
                ->sum('monthly_payment');
        });

        return $response;
    }

    public function activeProvider($providerId): int
    {
        $result = $this->model
            ->find($providerId);

        $response = $result->update([
            'status' => 1
        ]);

        return $response;
    }

    public function store(ProviderEntity $providerEntity): ProviderEntity
    {
        $result = $this->model->create([
            'user_id' => Auth::user()->id,
            'name' => $providerEntity->getName(),
            'email' => $providerEntity->getEmail(),
            'monthly_payment' => $providerEntity->getMonthlyPayment(),
        ]);

        if (!is_null($result)) {
            $providerEntity->setId($result->id);
        }

        return $providerEntity;
    }

    public function delete(int $id): int
    {
        return $this->model
            ->where('id', $id)
            ->where('user_id', Auth::user()->id)
            ->delete();
    }
}
