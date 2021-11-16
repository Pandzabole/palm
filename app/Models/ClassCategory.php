<?php

namespace App\Models;

use App\Models\ClassSubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ClassCategory extends Model
{
    use HasFactory;

    /**
     * @return string
     */
    public function slugable(): string
    {
        return $this->name;
    }
}
