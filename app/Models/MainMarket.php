<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\App;

class MainMarket extends Model
{
    use HasFactory;

    /** @var int ALL_MARKETS */
    public const ALL_MARKETS = 1;

    /** @var int MAIN_MARKETS */
    public const MAIN_MARKETS = 2;

    /** @var int MICRO_MARKETS */
    public const MICRO_MARKETS = 3;

    /**
     * MainMarket constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (!App::runningUnitTests()) {
            $this->table = config('database.default_database') . '.main_markets';
        }
    }

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'name',
        'href',
    ];

    /** @var string $sortable */
    public $sortable = 'position';

    /**
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
