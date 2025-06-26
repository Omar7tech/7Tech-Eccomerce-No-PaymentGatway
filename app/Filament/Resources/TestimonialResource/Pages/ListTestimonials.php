<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Storage;

class ListTestimonials extends ListRecords
{
    protected static string $resource = TestimonialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->modalWidth('2xl')
                ->createAnother(false)
                ->successNotificationTitle('Testimonial created successfully!')
                ->after(function ($record, $data) {
                    // Any additional logic after creation if needed
                }),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // You can add widgets here if needed
        ];
    }

    public function getTitle(): string
    {
        return 'Testimonials Management';
    }

    public function getSubheading(): string
    {
        return 'Manage customer testimonials and reviews';
    }
}