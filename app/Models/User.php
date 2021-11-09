<?php

namespace App\Models;

use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\App;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    /** @var int MAIN_ADMIN */
    public const MAIN_ADMIN = 1;

    /** @var int ADMIN */
    public const ADMIN = 2;

    /** @var int MICRO_ADMIN */
    public const MICRO_ADMIN = 3;

    /**
     * User constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (!App::runningUnitTests()) {
            $this->table = config('database.default_database') . '.users';
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @return BelongsToMany
     */
    public function mainMarkets(): BelongsToMany
    {
        return $this->belongsToMany(MainMarket::class);
    }

    /**
     * @return bool
     */
    public function isMainAdmin(): bool
    {
        return $this->role_id === self::MAIN_ADMIN;
    }

    /**
     * @return bool
     */
    public function isSiteAdmin(): bool
    {
        return $this->role_id === self::ADMIN;
    }

    /**
     * @return bool
     */
    public function isMicroAdmin(): bool
    {
        return $this->role_id === self::MICRO_ADMIN;
    }

    /**
     * @return Repository|Application|mixed
     */
    public function getRoleNameAttribute()
    {
        return config('admins.admins.' . $this->role_id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function isAdmin(int $id): bool
    {
        return auth()->user()->id !== $id;
    }
}
