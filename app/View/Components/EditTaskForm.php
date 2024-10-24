<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditTaskForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $projects;
    public $categories;
    public $statuses;
    public $task;

    public function __construct($projects, $categories, $statuses, $task)
    {
        $this->projects = $projects;
        $this->categories = $categories;
        $this->statuses = $statuses;
        $this->task = $task;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.edit-task-form');
    }
}
