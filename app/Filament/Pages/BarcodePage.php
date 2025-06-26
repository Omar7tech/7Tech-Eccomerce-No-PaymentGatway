<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class BarcodePage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-qr-code';
    protected static ?string $navigationGroup = 'Marketing';
    protected static ?string $navigationLabel = 'Homepage QR Code';
    protected static string $view = 'filament.pages.barcode-page';
    protected static ?int $navigationSort = 99;

    public function getHomepageUrl(): string
    {
        return url('/');
    }
}