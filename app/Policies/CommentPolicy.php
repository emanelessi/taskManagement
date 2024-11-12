<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasRole('administrator') || $user->hasPermissionTo('manage comments');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Comment $comment): bool
    {
        return $user->id === $comment->created_by || $user->hasRole('administrator') || $user->hasPermissionTo('manage comments');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasRole('administrator') || $user->hasPermissionTo('create comments');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user): bool
    {
        return  $user->hasRole('administrator') || $user->hasPermissionTo('edit comments');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user ): bool
    {
        return   $user->hasRole('administrator') || $user->hasPermissionTo('delete comments');
    }
}
