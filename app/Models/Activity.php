<?php

namespace App\Models;

use App\Repositories\Contracts\ActivitiesRepository;
use App\Traits\Mediable;
use App\Traits\Pageable;
use App\Traits\Publishable;
use App\Traits\Slug;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Activity extends Model
{
    use Slug;
    use Mediable;
    use Pageable;
    use HasFactory;
    use Publishable;

    /** @var string $type */
    public $type = 'activity';

    /** @var string $repo */
    public $repo = ActivitiesRepository::class;

    /** @var bool $additionalData */
    public $additionalData;

    /** @var string $sortable */
    public $sortable = 'position';

    /** @var bool $metaData */
    public $metaData;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title',
        'position',
        'description',
        'activity_component_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'created_at' => 'datetime:d.m.Y',
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'categories',
        'media'
    ];

    /**
     * @return string
     */
    public function slugable(): string
    {
        return $this->title;
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(ActivityCategory::class);
    }

    /**
     * @return void
     */
    public function sendResponseContentData(): void
    {
        $this->additionalData = true;
    }

    /**
     * @return void
     */
    public function sendResponseMetaData(): void
    {
        $this->metaData = true;
    }
}
