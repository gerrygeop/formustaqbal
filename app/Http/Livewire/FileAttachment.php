<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FileAttachment extends Component
{
    public $path;
    public $classes;

    public function render()
    {
        return view('livewire.file-attachment');
    }
}
