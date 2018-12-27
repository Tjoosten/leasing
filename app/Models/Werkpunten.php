<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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
