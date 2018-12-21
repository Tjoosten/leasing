<?php 

namespace App\Repositories; 

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder; 

/**
 * Class userRepository 
 * 
 * @package App\Repository
 */
class UserRepository extends Authenticatable
{
    /**
     * Function for processing deletion requests (users)
     * 
     * @throws \Exception instance of ModelNotFoundException when no user entity is found. 
     * 
     * @param  Request $request The request information collection bag.
     * @return void
     */
    public function deleteUserAccount(Request $request): void 
    {
        $flashMessage = new FlashRepository; 

        if ($this->validateRequest($request->confirmation) && $this->delete()) {
            // Confirmation is valid && User has been deleted in the system.
            $undoLink = '<a href="'. route('admins.delete.undo', $this) .'" class="ml-2 no-underline">Undo</a>';

            $flashMessage->success("Het account voor {$this->name} is verwijderd uit de applicatie. {$undoLink}")->important();
        } else {
            $flashMessage->warning("Het gebruikers account voor {$this->name} kon niet worden verwijderd.")->important();
        }
    }

    /**
     * Confirm that the value from the confirmation in put is the same as the auth user his password.
     * 
     * @param  string $password The user given confirmation from the form. 
     * @return bool
     */
    private function validateRequest(string $password): bool 
    {
        return Hash::check($password, $this->getAuthPassword());
    }
}