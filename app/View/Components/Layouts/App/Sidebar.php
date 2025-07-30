<?php

namespace App\View\Components\Layouts\App;

use Illuminate\View\Component;

class Sidebar extends Component
{
    public $title;

    public function __construct($title = null)
    {
        $this->title = $title;
    }

    public function render()
    {
        return view('components.layouts.app.sidebar');
    }
} 