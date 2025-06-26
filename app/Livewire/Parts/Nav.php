<?php

namespace App\Livewire\Parts;

use App\Settings\ContentSettings;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class Nav extends Component
{
    public ContentSettings $content;
    public Category $categories;

    public function mount($content, $categories)
    {
        $this->content = $content;
        $this->categories = $categories;
    }
    public function render()
    {
        return view('livewire.parts.nav');
    }
}
