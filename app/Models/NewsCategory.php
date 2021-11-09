<?php

namespace App\Models;

use App\Traits\Publishable;
use App\Traits\Slug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    use Slug;
    use HasFactory;
    use Publishable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'slug'
    ];

    /**
     * @return string
     */
    public function slugable(): string
    {
        return $this->name;
    }
}
