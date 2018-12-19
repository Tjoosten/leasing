<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Spatie\Permission\Models\Role;
use App\Http\Requests\Users\Settings\{SecurityValidator, InformationValidator};

/**
 * Class SettingsController
 * 
 * @package App\Http\Controllers\Users
 */
class SettingsController extends Controller
{
    /**
     * SettingsController constructor 
     * 
     * @return void
     */
    public function __construct() 
    {
        parent::__construct(); // Initiate the global constructor for the controllers.
        $this->middleware(['auth']);
    }

    /**
     * Display the settings page for the user account. 
     * 
     * @param  Request $request The request instance that holds all the request information. 
     * @return View
     */
    public function index(Request $request): View
    {
        if ($request->filter === 'information') {
            return view('users.settings.information', ['roles' => Role::all()]);
        }

        return view('users.settings.security');
    }

    /**
     * Method or update the security settings from the authenticated user. 
     * 
     * @param  SecurityValidator $input The form request class that handles the input validation.
     * @return RedirectResponse
     */
    public function updateSecurity(SecurityValidator $input): RedirectResponse
    {
        if ($this->auth->user()->update($input->all)) {
            $this->flashMessage->success(__('account.settings.flash-info-update'));
        }

        return redirect()->route('account.settings', ['type' => 'security']);
    }

    /**
     * Update the user profile information from the authenticated user. 
     * 
     * @param  InformationValidator $input The form request class that handles the input validation.
     * @return RedirectResponse
     */
    public function updateInformation(InformationValidator $input): RedirectResponse
    {
        if ($this->auth->user()->update($input->all())) {
            $this->flashMessage->success(__('account.settings.flash-security-update'))->important();
        }

        return redirect()->route('account.settings');
    }


}
