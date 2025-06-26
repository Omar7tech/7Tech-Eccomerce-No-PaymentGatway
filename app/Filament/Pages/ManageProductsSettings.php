<?php

namespace App\Filament\Pages;

use App\Settings\ProductsSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageProductsSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Products Settings';
    protected static ?string $title = 'Products Settings';
    protected static string $settings = ProductsSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Product Card Mode')
                    ->description('Choose the display mode for product cards')
                    ->icon('heroicon-o-view-columns')
                    ->schema([
                        Forms\Components\Select::make('card_mode')
                            ->label('Card Mode')
                            ->options([
                                1 => 'Mode 1',
                                2 => 'Mode 2',
                            ])
                            ->default(1)
                            ->required()
                            ->native(false)
                            ->helperText('Choose between two product card display modes'),
                    ])
                    ->columns(1),
                Forms\Components\Section::make('Stock Settings')
                    ->description('Control how product stock is handled and displayed')
                    ->icon('heroicon-o-cube')
                    ->schema([
                        Forms\Components\Toggle::make('work_with_stock')
                            ->label('Work with Stock')
                            ->helperText('If enabled, customers cannot add more items to the cart than are in stock.')
                            ->default(false)
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('show_low_stock')
                            ->label('Show Low Stock Badge')
                            ->helperText('Show a badge when product stock is low.')
                            ->default(false)
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('low_stock_threshold')
                            ->label('Low Stock Threshold')
                            ->helperText('Number below which a product is considered low stock.')
                            ->numeric()
                            ->default(5)
                            ->minValue(1)
                            ->visible(fn($get) => $get('show_low_stock'))
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('show_stock_number')
                            ->label('Show Stock Number')
                            ->helperText('Display the actual stock number on product cards.')
                            ->default(false)
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }
}
