<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use App\Models\Project;
use App\Models\Status;
use App\Models\Task;
use App\Policies\CategoryPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\ReportPolicy;
use App\Policies\StatusPolicy;
use App\Policies\TaskPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,
        Task::class => TaskPolicy::class,
        Status::class => StatusPolicy::class,
        Category::class => CategoryPolicy::class,


    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
