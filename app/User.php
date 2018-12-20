<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * @package App
 */
class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'last_login_at', 'last_login_ip'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'last_login_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Method for hashing the given password in the application storage. 
     * 
     * @param  string $password The given or generated password from the application/form.
     * @return void
     */
    public function setPasswordAttribute(string $password): void 
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Get all the users that are registered on the current day.
     *
     * @param  Builder $query The Eloquent ORm query builder instance. 
     * @return Builder
     */
    public function scopeRegisteredToday($query): Builder
    {
        return $query->whereDate('created_at', now()->today());
    }
}
