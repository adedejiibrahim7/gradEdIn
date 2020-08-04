<?php

namespace App\Policies;

use App\User;
use App\opportunity;
use Illuminate\Auth\Access\HandlesAuthorization;

class OpportunityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\opportunity  $opportunity
     * @return mixed
     */
    public function view(User $user, opportunity $opportunity)
    {
        return auth()->user()->id === $opportunity->user_id;
//        return $user->id == $opportunity->user_id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\opportunity  $opportunity
     * @return mixed
     */
    public function update(User $user, opportunity $opportunity)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\opportunity  $opportunity
     * @return mixed
     */
    public function delete(User $user, opportunity $opportunity)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\opportunity  $opportunity
     * @return mixed
     */
    public function restore(User $user, opportunity $opportunity)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\opportunity  $opportunity
     * @return mixed
     */
    public function forceDelete(User $user, opportunity $opportunity)
    {
        //
    }
}
