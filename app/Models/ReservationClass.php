<?php

namespace App\Models;

use App\Models\Classe;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;


class ReservationClass extends Model
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'comment',
        'phone',
        'country',
        'city',
        'classe_id',
        'teacher_id',
        'read_reservation',
        'reply_client',
        'amount'
    ];

    protected $with = [
        'teacher',
        'classe'
    ];

    /**
     * @param Builder $query
     * @param false $answered
     * @return Builder
     */
    public function scopeAnswered(Builder $query, $answered = true): Builder
    {
        return $query->where('reply_client', $answered);
    }

    /**
     * @return BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * @return BelongsTo
     */
    public function classe(): BelongsTo
    {
        return $this->belongsTo(Classe::class);
    }
}
