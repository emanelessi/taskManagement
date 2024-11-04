<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Status;
use Illuminate\Auth\Access\HandlesAuthorization;

class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any statuses.
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('manage statuses');
    }

    /**
     * Determine whether the user can view the status.
     */
    public function view(User $user, Status $status)
    {
        return $user->hasPermissionTo('manage statuses');
    }

    /**
     * Determine whether the user can create statuses.
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create statuses');
    }

    /**
     * Determine whether the user can update the status.
     */
    public function update(User $user, Status $status)
    {
        return $user->hasPermissionTo('edit statuses');
    }

    /**
     * Determine whether the user can delete the status.
     */
    public function delete(User $user, Status $status)
    {
        return $user->hasPermissionTo('delete statuses');
    }
}
