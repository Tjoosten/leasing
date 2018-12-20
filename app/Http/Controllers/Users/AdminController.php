<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use App\User;

/**
 * Class AdminController
 * 
 * @package App\Http\Controllers\Users
 */
class AdminController extends Controller
{
    /**
     * AdminController constructor 
     * 
     * @return void
     */
    public function __construct() 
    {
        parent::__construct(); // Initiate the global constructor
        $this->middleware(['auth', 'role:admin']);
    }

    /**
     * Method for getting and displaying all the administrators for the application. 
     * 
     * @param  User $users The database model for the users table. 
     * @return View 
     */
    public function index(User $users): View
    {
        $users = $users->role(['admin', 'leiding'])->simplePaginate();
        return view('users.index', compact('users'));
    }
}
