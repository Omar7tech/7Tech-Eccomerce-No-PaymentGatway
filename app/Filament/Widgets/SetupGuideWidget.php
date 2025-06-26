<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class SetupGuideWidget extends Widget
{
    protected static string $view = 'filament.widgets.setup-guide-widget';
    protected static ?int $sort = 2;

    public function getColumnSpan(): int|string|array
    {
        return 'full';
    }
}