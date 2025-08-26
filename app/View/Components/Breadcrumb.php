<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component
{
    public $links;

    /**
     * @param array $links -> contoh: ['Home' => '/', 'Projects' => '/projects', 'Flowbite' => null]
     */
    public function __construct($links = [])
    {
        $this->links = $links;
    }

    public function render(): View|Closure|string
    {
        return view('components.breadcrumb');
    }
}
