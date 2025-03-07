<?php

namespace App\Policies;

use App\Models\Attachment;
use App\Models\User;

class AttachmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return  $user->hasRole('administrator') || $user->hasPermissionTo('manage attachments');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Attachment $attachment): bool
    {
        return $user->id === $attachment->user_id || $user->hasRole('administrator') || $user->hasPermissionTo('manage attachments');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('administrator')  || $user->hasPermissionTo('create attachments');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Attachment $attachment): bool
    {
        return $user->id === $attachment->user_id || $user->hasRole('administrator')  || $user->hasPermissionTo('edit attachments');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Attachment $attachment): bool
    {
        return   $user->id === $attachment->user_id || $user->hasRole('administrator')  || $user->hasPermissionTo('delete attachments');
    }


}
