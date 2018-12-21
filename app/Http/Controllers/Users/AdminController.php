<?php

namespace App\Http\Controllers\Users;

use Gate;
use Illuminate\Http\{Request, RedirectResponse};
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Mpociot\Reanimate\ReanimateModels;
use App\User;

/**
 * Class AdminController
 * 
 * @package App\Http\Controllers\Users
 */
class AdminController extends Controller
{
    use ReanimateModels;

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

    /**
     * Method for deleting admin users in the application.
     * 
     * @param  Request $request  The form request instance that holds all the request information. 
     * @param  User    $admin    The resource entity form the given administrator.  
     * @return View|RedirectResponse
     */
    public function destroy(Request $request, User $admin)
    {
        if ($request->isMethod('GET')) {
            $viewPath = (Gate::allows('same-user', $admin)) ? 'users.settings.delete' : 'users.delete';
            return view($viewPath, compact('admin'));
        }

        // Method is a DELETE request so move on with the logic.
        $this->validate($request, ['confirmation' => 'required']); 
        $admin->deleteUserAccount($request);

        return redirect()->route('admins.index');
    }

    /**
     * Undo the delete for the user in the application.
     * 
     * @throws \Exception instance of ModelNotFoundException when no valid user entity is found.
     * 
     * @param  int $admin The unique resource entity identifier from the admin.
     * @return RedirectResponse
     */
    public function undoDeleteRoute(int $admin): RedirectResponse 
    {
        $user = User::onlyTrashed()->findOrFail($admin);

        $this->flashMessage->info("De verwijdering van {$user->name} is ongedaan gemaakt in de applicatie.");
        return $this->restoreModel($user->id, new User(), 'admins.index');
    }
}
