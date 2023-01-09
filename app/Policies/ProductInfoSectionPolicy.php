<?php

namespace App\Policies;

use App\Models\ProductInfoSection;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductInfoSectionPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductInfo  $productInfo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ProductInfoSection $productInfoSection)
    {
        return $user->id === $productInfoSection->user_id && $user->tokenCan('update');
    }


    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductInfo  $productInfo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ProductInfoSection $productInfoSection)
    {
        return $user->id === $productInfoSection->user_id && $user->tokenCan('delete');
    }
}
