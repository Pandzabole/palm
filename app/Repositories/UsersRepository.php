<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UsersRepository as UserRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class UsersRepository extends EloquentRepository implements UserRepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function findAdminUser(): ?User
    {
        return $this->model->firstWhere('email', config('auth.admin.email'));
    }
}
