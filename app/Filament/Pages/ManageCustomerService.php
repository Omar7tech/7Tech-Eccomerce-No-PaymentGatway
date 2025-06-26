<?php

namespace App\Filament\Pages;

use App\Settings\CustomerServiceSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageCustomerService extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static string $settings = CustomerServiceSettings::class;
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Customer Service Settings';
    protected static ?string $title = 'Customer Service Settings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Tawk.to Setup Guide')
                    ->description('Follow these simple steps to integrate Tawk.to live chat')
                    ->schema([
                        Forms\Components\View::make('filament.components.tawk-guide')
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->collapsed(false),

                Forms\Components\Section::make('Customer Service Configuration')
                    ->description('Configure your customer service widget and chat settings')
                    ->schema([
                        Forms\Components\Toggle::make('active')
                            ->label('Enable Customer Service')
                            ->helperText('Turn on/off the customer service functionality')
                            ->default(false),

                        Forms\Components\Textarea::make('widgetCode')
                            ->label('Widget Code')
                            ->helperText('Paste your Tawk.to widget HTML/JavaScript code here')
                            ->placeholder('<!-- Your Tawk.to widget code here -->')
                            ->rows(6)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('directChatLink')
                            ->label('Direct Chat Link')
                            ->helperText('Direct link to your customer service chat (optional)')
                            ->placeholder('https://tawk.to/chat/YOUR_PROPERTY_ID')
                            ->url()
                            ->suffixIcon('heroicon-m-link')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
