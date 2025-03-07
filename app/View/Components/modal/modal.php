<?php

namespace App\View\Components\modal;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class modal extends Component
{
    public $id;
    public $title;
    public $message;
    public $btn;
    public $btnId;
    /**
     * Create a new component instance.
     */
    public function __construct(string $id, string $title, string $message, string $btn, string $btnId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->message = $message;
        $this->btn = $btn;
        $this->btnId = $btnId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal.modal');
    }
}
