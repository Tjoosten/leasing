<?php

namespace App\Http\Controllers\Users;

use App\Http\Requests\Users\CreateValidator;
use Gate;
use Illuminate\Http\{Request, RedirectResponse};
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Mpociot\Reanimate\ReanimateModels;
use App\User;
use Spatie\Permission\Models\Role;

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
        $this->middleware(['auth', 'role:admin, webmaster']);
    }

    /**
     * Method for getting and displaying all the administrators for the application. 
     * 
     * @param  Request  $request Request instance that holds all the request data and information.
     * @param  User     $users   The database model for the users table. 
     * @return View 
     */
    public function index(Request $request, User $users): View
    {
        $baseQuery = $users->role(['leiding', 'admin']);

        switch ($request->filter) {
            case 'deleted': $baseQuery->onlyTrashed(); break;
        }

        return view('users.index', ['users' => $baseQuery->simplePaginate()]);
    }

    /**
     * Method for deleting admin users in the application.
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @param  Request $request The form request instance that holds all the request information.
     * @param  User $admin The resource entity form the given administrator.
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
     * Methode voor het creeren van nieuwe leiding of administrators in de applicatie. 
     *
     * @return View
     */
    public function create(): View
    {
        $roles = Role::where('name', '!=', 'huurder')->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Methode voor het opslaan van een nieuw account in de applicatie.
     *
     * @see \App\Observers\UserObserver::created()
     *
     * @param  CreateValidator $input De validate class dat verantwoordelijk is voor de validatie.
     * @return RedirectResponse
     */
    public function store(CreateValidator $input): RedirectResponse
    {
        if ($user = new User($input->all())) {
            $flashText = "De gebruiker <strong>{$user->name}</strong> is geregisteerd in de applicatie.";
            $this->flashMessage->success($flashText)->important();
        }

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
