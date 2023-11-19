<?php

namespace App\Policies;

use App\Models\Product;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
   
    public function before($user, $ability)
    {
        if ($user->hasRole('admin')) {
            return true;
        }
    }

    public function browse(User $user)
    {
        return $user->hasRole('seller');
    }


    public function read(User $user, Product $Product)
    {
        return $user->id == $Product->shop->user_id;
    }

    /**
     * Determine whether the user can update the Product.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $Product
     * @return mixed
     */
    public function edit(User $user, Product $Product)
    {
        if(empty($Product->shop)){
            return false;
        }
        return $user->id == $Product->shop->user_id;
    }


    /**
     * Determine whether the user can create Products.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function add(User $user)
    {
        
        return $user->hasRole('seller');
    }

    /**
     * Determine whether the user can delete the Product.
     *
     * @param  \App\User  $user
     * @param  \App\Product  $Product
     * @return mixed
     */
    public function delete(User $user, Product $Product)
    {
        if(empty($Product->shop)){
            return false;
        }
        return $user->id == $Product->shop->user_id;
    }

}
