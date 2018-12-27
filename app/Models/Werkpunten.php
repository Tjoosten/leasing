<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Werkpunten
 *
 * @package App\Models
 */
class Werkpunten extends Model
{
    /**
     * The attributes that are mass-assignable to the database table.
     *
     * @var array
     */
    protected $fillable = ['title', 'extra_informatie'];

    /**
     * Data relatie voor de autheur van het werkpuntje.
     *
     * @return BelongsTo
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * De query scope voor het openhalen van werkpunten met een open of gesloten status.
     * QUERY: WHERE = is_open = <status>
     *
     * @param  Builder $query  De eloquent query builder instantie.
     * @param  bool    $status
     * @return Builder
     */
    public function scopeIsOpen(Builder $query, bool $status): Builder
    {
        return $query->where('is_open', $status);
    }
}
