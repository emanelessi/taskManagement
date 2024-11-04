<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;
use Illuminate\Auth\Access\HandlesAuthorization;

class CategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any categories.
     */
    public function viewAny(User $user)
    {
        return $user->can('manage categories');
    }

    /**
     * Determine whether the user can view the category.
     */
    public function view(User $user, Category $category)
    {
        return $user->can('manage categories');
    }

    /**
     * Determine whether the user can create categories.
     */
    public function create(User $user)
    {
        return $user->can('create categories');
    }

    /**
     * Determine whether the user can update the category.
     */
    public function update(User $user, Category $category)
    {
        return $user->can('edit categories');
    }

    /**
     * Determine whether the user can delete the category.
     */
    public function delete(User $user, Category $category)
    {
        return $user->can('delete categories');
    }
}
