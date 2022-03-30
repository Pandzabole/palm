<?php

namespace App\Repositories;

use App\Repositories\Contracts\ClassesRepository as ClassesRepositoryInterface;
use App\Repositories\Infrastructure\EloquentRepository;

class ClassesRepository extends EloquentRepository implements ClassesRepositoryInterface
{

    /**
     * @param string $request
     * @return mixed|void
     */
    public function searchData(
        string $request
    )
    {
        $query = $this->model->with('classCategory', 'classSubCategory')
            ->where(function ($query) use ($request) {
                if ($request) {
                    $query->where('name', 'Like', '%' . $request . '%')
                        ->orWhereHas('classCategory', function ($query) use ($request) {
                            $query->where('name', 'Like', '%' . $request . '%');
                        })
                        ->orWhereHas('classSubCategory', function ($query) use ($request) {
                            $query->where('name', 'Like', '%' . $request . '%');
                        });

                }
            });

//        return $query->paginate(5);
        return $query->get();
    }
}
