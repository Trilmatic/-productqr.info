<?php

namespace App\Policies;

use App\Models\ProductInfo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductInfoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductInfo  $productInfo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function read(User $user, ProductInfo $productInfo)
    {
        return $user->id === $productInfo->user_id && $user->tokenCan('read');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductInfo  $productInfo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ProductInfo $productInfo)
    {
        return $user->id === $productInfo->user_id && $user->tokenCan('update');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductInfo  $productInfo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ProductInfo $productInfo)
    {
        return $user->id === $productInfo->user_id && $user->tokenCan('delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ProductInfo  $productInfo
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ProductInfo $productInfo)
    {
        return $user->id === $productInfo->user_id && $user->tokenCan('update');
    }
}
