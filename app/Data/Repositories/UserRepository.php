<?php

namespace App\Data\Repositories;

use App\Data\Models\User;

class UserRepository
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function validateLogin()
    {

    }
}
