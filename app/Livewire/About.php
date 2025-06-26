<?php

namespace App\Livewire;

use Livewire\Component;

class About extends Component
{
    public function render()
    {
        $aboutPageSettings = resolve(\App\Settings\AboutPageSettings::class);
        return view('livewire.about' , compact('aboutPageSettings'));
    }
}
