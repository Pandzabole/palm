<?php

namespace App\Models;

use App\Traits\Publishable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Mediable;
use App\Traits\Slug;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use Slug;
    use Mediable;
    use HasFactory;
    use Publishable;

    /** @var string $sortable */
    public $sortable = 'position';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'position',
        'description',
        'package_number_id',
        'package_volume_id',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'media',
        'packageVolume',
        'packageNumber'
    ];

    /**
     * @return string
     */
    public function slugable(): string
    {
        return $this->name;
    }

    /**
     * @return BelongsTo
     */
    public function packageVolume(): BelongsTo
    {
        return $this->belongsTo(PackageVolume::class);
    }

    /**
     * @return BelongsTo
     */
    public function packageNumber(): BelongsTo
    {
        return $this->belongsTo(PackageNumber::class);
    }
}
