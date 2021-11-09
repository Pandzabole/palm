<?php

namespace App\Repositories\Contracts;

use App\Models\User;
use App\Repositories\Infrastructure\BaseRepository;

interface UsersRepository extends BaseRepository
{
    /**
     * @return User|null
     */
    public function findAdminUser(): ?User;
}
