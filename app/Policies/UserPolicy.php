<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('manage users');
    }

    public function view(User $user, User $model)
    {
        return $user->hasPermissionTo('manage users') || $user->id === $model->id;
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('create users');
    }

    public function update(User $user, User $model)
    {
        return $user->hasPermissionTo('edit users') || $user->id === $model->id;
    }

    public function delete(User $user, User $model)
    {
        return $user->hasPermissionTo('delete users') && $user->id !== $model->id;
    }
}
