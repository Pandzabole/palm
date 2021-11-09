<?php

namespace App\Models;

use App\Traits\Publishable;
use App\Traits\Slug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MiscInformation extends Model
{
    use Slug;
    use HasFactory;
    use Publishable;

    /** @var string[] TYPES */
    public const TYPES = [
        'phone',
        'mail',
        'address',
        'text',
        'long-text',
        'internal-link',
        'external-link',
    ];

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'value',
    ];

    /**
     * @return string
     */
    public function slugable(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isLongText(): bool
    {
        return $this->type === 'long-text';
    }
}
