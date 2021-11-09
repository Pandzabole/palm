<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $model
     * @param int $id
     * @return mixed
     */
    public function delete(User $model, int $id)
    {
        return $model->isAdmin($id);
    }
}
