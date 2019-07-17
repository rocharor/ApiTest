<?php

namespace App\Data\Repositories;

use App\Data\Models\Provider;
use App\Data\Entities\ProviderEntity;

class ProviderRepository
{
    private $model;

    public function __construct(Provider $model)
    {
        $this->model = $model;
    }

    public function findAll(int $userId): ?array
    {
        $result = $this->model
            ->where('user_id', $userId)
            ->get();

        $response = null;
        foreach ($result as $value) {
            $response[] = (new ProviderEntity)
                ->setId($value->id)
                ->setUserId($value->user_id)
                ->setName($value->name)
                ->setEmail($value->email)
                ->setMonthlyPayment($value->monthly_payment);
        }

        // return $response;
        return $response;
    }
}
