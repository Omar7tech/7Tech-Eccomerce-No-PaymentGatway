<?php

namespace App\Filament\Pages;

use App\Settings\CartSettings;
use App\Settings\ContactSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Forms\Get;
use Illuminate\Support\HtmlString;

class ManageCartSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Cart Settings';
    protected static ?string $title = 'Cart Settings';
    protected static string $settings = CartSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Cash on Delivery Settings')
                    ->description('Configure cash on delivery payment options')
                    ->icon('heroicon-o-credit-card')
                    ->schema([
                        Forms\Components\Toggle::make('cashOnDeliveryActive')
                            ->label('Enable Cash on Delivery')
                            ->helperText('Allow customers to pay with cash when their order is delivered')
                            ->default(true)
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('takeDefaultWhatsappNumber')
                            ->label('Use Default WhatsApp Number')
                            ->helperText('Use the WhatsApp number from contact settings instead of a custom one')
                            ->default(true)
                            ->reactive()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('cashOnDeliveryWhatsappNumber')
                            ->label('Custom WhatsApp Number for COD')
                            ->helperText('WhatsApp number for cash on delivery orders (only used if "Use Default WhatsApp Number" is disabled)')
                            ->placeholder('+96171387946')
                            ->tel()
                            ->visible(fn(Get $get): bool => !$get('takeDefaultWhatsappNumber'))
                            ->columnSpanFull(),
                    ])
                    ->columns(1),

                Forms\Components\Section::make('Delivery Settings')
                    ->description('Configure delivery pricing and options')
                    ->icon('heroicon-o-truck')
                    ->schema([
                        Forms\Components\Toggle::make('deliveryFree')
                            ->label('Free Delivery')
                            ->helperText('Enable free delivery for all orders')
                            ->default(true)
                            ->reactive()
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('deliveryPrice')
                            ->label('Delivery Price')
                            ->helperText('Set the delivery price (only used if "Free Delivery" is disabled)')
                            ->placeholder('0.00')
                            ->numeric()
                            ->prefix('$')
                            ->step(0.01)
                            ->minValue(0)
                            ->visible(fn(Get $get): bool => !$get('deliveryFree'))
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }
}
