<?php

namespace App\Repositories;

use App\Repositories\Infrastructure\EloquentRepository;
use App\Repositories\Contracts\ContactsRepository as ContactsRepositoryInterface;

class ContactsRepository extends EloquentRepository implements ContactsRepositoryInterface
{
}
