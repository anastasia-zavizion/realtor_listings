<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListingPolicy
{
    public function before(?User $user, $ability)
    {
        if($user){
            if($user->is_admin  && $ability === 'update'){
                return true;
            }
        }
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Listing $listing): bool
    {
       if($user?->id === $listing->user_id){
           return true;
       }else{
           return is_null($listing->sold_at);
       }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {

        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Listing $listing): bool
    {
        return ($listing->user_id === $user->id) && is_null($listing->sold_at) ;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Listing $listing): bool
    {

        return $listing->user_id === $user->id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Listing $listing): bool
    {

        return $listing->user_id === $user->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Listing $listing): bool
    {

        return $listing->user_id === $user->id;
    }



}
