<?php

namespace App\Models;

use App\Traits\Slug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassCategory extends Model
{
    use HasFactory;
    use Slug;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return string
     */
    public function slugable(): string
    {
        return $this->name;
    }
}
