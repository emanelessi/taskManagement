<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $message;
    public $errors;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $message = null, $errors = [])
    {
        $this->type = $type;
        $this->message = $message;
        $this->errors = $errors;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}
