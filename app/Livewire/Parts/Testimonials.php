<?php

namespace App\Livewire\Parts;

use App\Models\Testimonial;
use App\Settings\ContentSettings;
use Livewire\Component;

class Testimonials extends Component
{
    public function render()
    {
        $content = app(ContentSettings::class);

        $testimonials = Testimonial::where('active', true)
            ->orderBy('sort')
            ->orderByDesc('created_at')
            ->get();

        // Choose view based on design setting
        $view = $content->testimonial_design == 2 ? 'livewire.parts.testimonials2' : 'livewire.parts.testimonials';

        return view($view, compact('testimonials', 'content'));
    }
}
