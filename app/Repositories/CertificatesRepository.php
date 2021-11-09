<?php

namespace App\Repositories;

use App\Repositories\Contracts\CertificatesRepository as CertificatesRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class CertificatesRepository extends EloquentRepository implements CertificatesRepositoryInterface
{
}
