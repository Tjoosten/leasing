<?php

namespace App\Policies;

use App\User;
use App\Models\Lokalen;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Class LokalenPolicy 
 * 
 * @package App\Policies
 */
class LokalenPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the lokalen.
     *
     * @param  User     $user       De db entiteit van de aangemelde gebruiker.
     * @param  Lokalen  $lokalen    De databank entiteit van het gegeven lokaal.
     * @return bool
     */
    public function werkpuntCreatie(User $user, Lokalen $lokalen): bool
    {
        return $lokalen->count() > 0 && $user->hasAnyRole('admin', 'leiding');
    }
}
