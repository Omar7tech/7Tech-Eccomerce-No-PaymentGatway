<?php

namespace App\Livewire\Parts;

use App\Models\Banner;
use Livewire\Component;

class Banners extends Component
{
    public function render()
    {
        $banners = Banner::all();
        return view('livewire.parts.banners' , compact('banners'));
    }
}
