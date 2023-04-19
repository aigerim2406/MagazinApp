<?php

namespace App\Policies;

use App\Models\Shop;
use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class ShopPolicy
{
    use HandlesAuthorization;


    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Shop $shop)
    {
        //
    }

    public function create(User $user) //create,store
    {
        return $user->role->name == 'admin';
    }

    public function update(User $user, Shop $shop)
    {
        return ($user->id == $shop->user->id) || ($user->role->name == 'admin');
    }

    public function delete(User $user, Shop $shop)
    {
        return ($user->id == $shop->user->id) || ($user->role->name != 'user');
    }

    public function restore(User $user, Shop $shop)
    {
        //
    }


    public function forceDelete(User $user, Shop $shop)
    {
        //
    }
}
