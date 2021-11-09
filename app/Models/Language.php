<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'published'
    ];

    /**
     * The attributes that are not exposed via api.
     *
     * @var array
     */
    public $hidden = [
        'created_at',
        'updated_at',
        'connection_name',
    ];
}
