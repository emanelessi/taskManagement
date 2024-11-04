<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Project;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->hasRole('administrator') || $user->hasPermissionTo('manage projects');
    }

    public function manage (User $user, Project $project)
    {
        return $user->id === $project->created_by || $user->hasRole('administrator') || $user->hasPermissionTo('manage projects');
    }

    public function create(User $user)
    {
        return $user->hasPermissionTo('create projects');
    }

    public function update(User $user, Project $project)
    {
        return $user->id === $project->created_by || $user->hasRole('administrator') || $user->hasPermissionTo('edit projects');
    }

    public function delete(User $user, Project $project)
    {
        return $user->id === $project->created_by || $user->hasRole('administrator') || $user->hasPermissionTo('delete projects');
    }
    public function viewProjectDetails(User $user, Project $project)
    {
        return $user->id === $project->user_id || $user->hasRole('administrator') || $user->hasPermissionTo('view project details');
    }
    public function viewProjectReport(User $user, Project $project)
    {
        return $user->hasRole('administrator') ||
            $user->hasPermissionTo('view project report') ||
            $user->projects()->where('id', $project->id)->exists();
    }

}
