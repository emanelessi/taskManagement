<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class TaskPolicy
{
    /**
     * Determine if the user can view any tasks.
     */
    public function viewAny(User $user)
    {
        return $user->hasRole('administrator') || $user->hasPermissionTo('manage tasks');
    }

    /**
     * Determine if the user can view the task.
     */
    public function view(User $user )
    {
        return $user->hasRole('administrator') ||$user->hasPermissionTo('manage tasks');
    }

    /**
     * Determine if the user can create tasks.
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create tasks');
    }

    /**
     * Determine if the user can update the task.
     */
    public function update(User $user )
    {
        return  $user->hasRole('administrator') || $user->hasPermissionTo('edit tasks');
    }

    /**
     * Determine if the user can delete the task.
     */
    public function delete(User $user )
    {
        return  $user->hasRole('administrator') ||$user->hasPermissionTo('delete tasks');
    }

    public function viewTaskDetails(User $user,  Task $task)
    {
        return $user->id === $task->assigned_to || $user->hasRole('administrator') || $user->hasPermissionTo('view task details');
    }

    public function viewTaskReport(User $user, Task $task)
    {
        return $user->id === $task->assigned_to ||
            $user->hasRole('administrator') ||
            $user->hasPermissionTo('view task report');
    }


}
