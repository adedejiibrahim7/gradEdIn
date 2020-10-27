<?php

namespace App\Policies;

use App\User;
use http\Env\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
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

    public function Admin(User $user){
        return $user->is_admin === true;
//            ?
//            Response::allow() :
//            Response::deny('You are not an admin');
    }
}
