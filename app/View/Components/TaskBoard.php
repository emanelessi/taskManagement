<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TaskBoard extends Component
{
    /**
     * Create a new component instance.
     */
    public $backlogCount;
    public $toDoCount;
    public $tasks;

    public function __construct($backlogCount = null, $toDoCount = null, $tasks = [])
    {
        $this->backlogCount = $backlogCount;
        $this->toDoCount = $toDoCount;
        $this->tasks = $tasks;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task-board');
    }
}
