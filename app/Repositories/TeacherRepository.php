<?php

namespace App\Repositories;

use App\Repositories\Contracts\TeacherRepository as TeacherRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class TeacherRepository extends EloquentRepository implements TeacherRepositoryInterface
{
}
