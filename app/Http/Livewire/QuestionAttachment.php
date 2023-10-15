<?php

namespace App\Http\Livewire;

use Livewire\Component;

class QuestionAttachment extends Component
{
    public $path;

    public function render()
    {
        return view('livewire.question-attachment');
    }
}
