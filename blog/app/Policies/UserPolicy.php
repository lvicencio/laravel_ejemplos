<?php

namespace App\Policies;

use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function before($user, $ability)
    {
        if ($user->hasRoles(['admin']))
        {
            return true;
        }
    }
 
//usuario logeado  es igual al que se desea editar
    // el "User $authUser" siempre debe estar
    public function edit(User $authUser, User $user)
    {
        return $authUser->id === $user->id;
    }

    public function update(User $authUser, User $user)
    {
        return $authUser->id === $user->id;
    }

     public function destroy(User $authUser, User $user)
    {
        return $authUser->id === $user->id;
    }
}
