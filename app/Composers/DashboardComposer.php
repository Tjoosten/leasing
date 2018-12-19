<?php 

namespace App\Composers; 

use Illuminate\View\View;
use App\User;

/**
 * Class DashboardComposer 
 * 
 * @package App\Composers
 */
class DashboardComposer 
{
    /** @var \App\User $user */
    protected $users; 

    /**
     * DashboardComposer constructor 
     * 
     * @param  User $user The model instance for the users database entity
     * @return void
     */
    public function __construct(User $users) 
    {
        $this->users = $users;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view The blade view builder instance.
     * @return void
     */
    public function compose(View $view): void
    {
        $view->with('users', $this->users);
    }
}