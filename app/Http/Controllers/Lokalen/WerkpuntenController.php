<?php

namespace App\Http\Controllers\Lokalen;

use Gate;
use Illuminate\Http\{RedirectResponse, Request};
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\Models\Lokalen;
use App\Http\Requests\Lokalen\WerkpuntValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Werkpunten;

/**
 * Class WerkpuntenController
 * 
 * @package App\Http\Controllers\Lokalen
 */
class WerkpuntenController extends Controller
{
    /**
     * Creer een nieuwe constructor voor de werkpunten controller. 
     * 
     * @return void 
     */
    public function __constructor() 
    {
        parent::__construct();
        $this->middelware(['auth', 'role:admin,leiding']);
    }

    /**
     * Methode voor de index weergave voor de werkpunten van een lokaal.
     * 
     * @param  Lokalen $lokaal De database entiteit van een lokaal
     * @return View
     */
    public function index(Lokalen $lokaal): View
    {
        dd('werkpunten index');
    }

    /**
     * Method voor de weergave van een nieuw werkpuntje. 
     * 
     * @param  Lokalen $lokalen Het database model voor de lokalen in de applicatie. 
     * @return RedirectResponse|View
     */
    public function create(Lokalen $lokalen)
    {
        if (Gate::allows('werkpunt-creatie', $lokalen)) {
            $lokalen = $lokalen->orderBy('name', 'asc')->get(['id', 'name']);
            return view('lokalen.werkpunten.create', compact('lokalen'));
        }

        $this->flashMessage->warning('U moet eerst een lokaal aanmaken. Voor u een werkpuntje kunt toevoegen.');
        return redirect()->route('lokalen.index');
    }

    /**
     * Methode voor het opslaan van een werkpuntje aan een lokaal. 
     * 
     * @todo Implementatie observer voor de notificatie en creator relatie. 
     * 
     * @param  WerkpuntValidator $input The form request instantie dat verantwoordelijk is voor de validatie. 
     * @return RedirectResponse
     */
    public function store(WerkpuntValidator $input): RedirectResponse
    {
        try { // To find a pplace with an valid id. 
            $werkpunt = new Werkpunten($input->except('lokalen_id'));
            $lokaal   = Lokalen::findOrFail($input->lokalen_id);

            if ($lokaal->werkpunten()->save($werkpunt)) {
                $this->flashMessage->success("Het werkpuntje voor het lokaal {$lokaal->name} is opgeslagen.");
            }
        } catch (ModelNotFoundException $exception) { // Geen valide ID gevonden voor een lokaal. 
            $this->flashMessage->danger('Wij konden het werkpuntje aan een lokaal niet opslaan.');
        }

        return redirect()->route('werkpunten.create');
    }
}
