<?php

namespace App\Http\Controllers;

use App\Models\Task;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $projects = Project::with('status')->get();

        $chart = new Chart();
        $chart->title(__('Projects'))
            ->labels($projects->pluck('status.name')->unique()->toArray())
            ->dataset(__('Project Count'), 'bar', $projects->groupBy('status_id')->map->count()->values()->toArray())
            ->options([
                'responsive' => false,
                'width' => 1000,
                'height' => 500,
                'backgroundColor' => [
                    '#6A5ACD', '#FFB6C1', '#87CEEB', '#FFD700', '#FF6347',
                    '#32CD32', '#BA55D3', '#20B2AA', '#FF4500', '#4682B4',
                ],
            ]);

        $project = Project::get();
        $cost = new Chart();
        $cost->title(__('Project Cost'))
            ->labels($project->pluck('cost')->unique()->toArray())
            ->dataset(__('Project Cost'), 'pie', $project->groupBy('cost')->map->count()->values()->toArray())
            ->options([
                'responsive' => false,
                'width' => 1000,
                'height' => 500,  'maintainAspectRatio' => false,
                'backgroundColor' => [
                    '#6A5ACD', '#FFB6C1', '#87CEEB', '#FFD700', '#FF6347',
                    '#32CD32', '#BA55D3', '#20B2AA', '#FF4500', '#4682B4',
                ],
            ]);

        // حساب المهام المكتملة هذا الأسبوع والأسبوع الماضي
        $completedTasksThisWeek = Task::where('status_id', 1)
            ->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])
            ->count();
        $completedTasksLastWeek = Task::where('status_id', 1)
            ->whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])
            ->count();
        $taskDifferenceText = $completedTasksThisWeek - $completedTasksLastWeek > 0
            ? "+".($completedTasksThisWeek - $completedTasksLastWeek)." more"
            : ($completedTasksThisWeek - $completedTasksLastWeek)." less";

        // حساب المهام الجديدة هذا الأسبوع والأسبوع الماضي
        $newTasksThisWeek = Task::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $newTasksLastWeek = Task::whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])->count();
        $newTaskDifferenceText = $newTasksThisWeek - $newTasksLastWeek > 0
            ? "+".($newTasksThisWeek - $newTasksLastWeek)." more"
            : ($newTasksThisWeek - $newTasksLastWeek)." less";

        // حساب المشاريع الجديدة هذا الأسبوع والأسبوع الماضي
        $newProjectsThisWeek = Project::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count();
        $newProjectsLastWeek = Project::whereBetween('created_at', [now()->subWeek()->startOfWeek(), now()->subWeek()->endOfWeek()])->count();
        $newProjectDifferenceText = $newProjectsThisWeek - $newProjectsLastWeek > 0
            ? "+".($newProjectsThisWeek - $newProjectsLastWeek)." more"
            : ($newProjectsThisWeek - $newProjectsLastWeek)." less";

        return view('cpanel.dashboard', compact(
            'chart', 'cost',
            'completedTasksThisWeek', 'completedTasksLastWeek', 'taskDifferenceText',
            'newTasksThisWeek', 'newTaskDifferenceText',
            'newProjectsThisWeek', 'newProjectDifferenceText'
        ));
    }


}
