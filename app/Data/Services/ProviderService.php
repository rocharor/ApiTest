<?php

namespace App\Data\Services;

use App\Data\Repositories\ProviderRepository;

class ProviderService
{
    private $repository;

    public function __construct(ProviderRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(int $userId)
    {
        return $this->repository->findAll($userId);
    }

    public function store(array $params)
    {

    }

    public function delete(array $params)
    {

    }
}
