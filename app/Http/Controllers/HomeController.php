<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

/**
 * Class HomeController
 * 
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->only('indexFrontend');
        $this->middleware('auth')->only('indexBackend');
    }

    /**
     * Get the welcome page for the application. 
     * ---- 
     * User will be redirect to the dashboard if he is authenticated. 
     * 
     * @return View
     */
    public function indexFrontend(): View
    {
        return view('auth.login');
    }

    /**
     * Show the application his dashboard. 
     * 
     * @return View
     */
    public function indexBackend(): View
    {
        return view('home');
    }
}
