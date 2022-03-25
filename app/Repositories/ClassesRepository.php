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
//        return $this->model->with($relation)
//            ->where($column, 'LIKE', '%' . $data . '%')
//            ->orWhere($columnRelation, 'LIKE', '%' . $data . '%')
//            ->orWhere($columnPivot, 'LIKE', '%' . $data . '%')
//            ->paginate(2);

         $query = $this->model->with('classCategory', 'classSubCategory')
            ->where(function($query) use ($request) {
                if ($request) {
                    $query->where('name', 'Like', '%' . $request . '%')
                        ->orWhereHas('classCategory', function ($query2) use ($request) {
                            $query2->where('name', 'Like', '%' . $request . '%');
                        });

                }
            });

        return $query->get()    ;
    }



}
