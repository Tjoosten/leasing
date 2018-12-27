<?php

namespace App\Observers;

use App\Models\Werkpunten;

class WerkpuntObserver
{
    /**
     * Handle the models werkpunten "created" event.
     *
     * @param  Werkpunten  $werkpunt De databank entiteit van het geregistreerd werkpunt.
     * @return void
     */
    public function created(Werkpunten $werkpunt)
    {
        $user = auth()->user();
        $werkpunt->creator()->associate($user)->save();
    }
}
