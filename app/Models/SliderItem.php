<?php

namespace App\Models;

use App\Traits\Mediable;
use App\Traits\Publishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderItem extends Model
{
    use Mediable;
    use HasFactory;
    use Publishable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'slider_id',
        'main_text',
        'second_text',
        'position'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'media'
    ];
}
