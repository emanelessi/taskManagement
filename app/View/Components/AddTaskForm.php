<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddTaskForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $projects;
    public $categories;
    public $statuses;

    public function __construct($projects, $categories, $statuses)
    {
        $this->projects = $projects;
        $this->categories = $categories;
        $this->statuses = $statuses;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.add-task-form');
    }
}
