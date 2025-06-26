<?php

namespace App\Filament\Pages;

use App\Settings\MailSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageMailSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Mail Settings';
    protected static ?string $title = 'Mail Settings';

    protected static string $settings = MailSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Mail Configuration')
                    ->description('Configure your email settings.')
                    ->schema([
                        Forms\Components\TextInput::make('mail_from_address')
                            ->label('From Address')
                            ->email()
                            ->required(),
                        Forms\Components\TextInput::make('mail_from_name')
                            ->label('From Name')
                            ->required(),
                        Forms\Components\Select::make('mail_mailer')
                            ->label('Mailer')
                            ->options([
                                'smtp' => 'SMTP',
                                'log' => 'Log',
                                'array' => 'Array',
                                'mailgun' => 'mailgun'
                            ])
                            ->default('smtp')
                            ->required(),
                        Forms\Components\TextInput::make('mail_host')
                            ->label('Host')
                            ->required(),
                        Forms\Components\TextInput::make('mail_port')
                            ->label('Port')
                            ->numeric()
                            ->required(),
                        Forms\Components\Select::make('mail_encryption')
                            ->label('Encryption')
                            ->options([
                                'tls' => 'TLS',
                                'ssl' => 'SSL',
                                'starttls' => 'STARTTLS',
                                null => 'None'
                            ])
                            ->default('tls'),
                        Forms\Components\TextInput::make('mail_username')
                            ->label('Username')
                            ->required(),
                        Forms\Components\TextInput::make('mail_password')
                            ->label('Password')
                            ->password()
                            ->required(),
                    ])
                    ->columns(2),
            ]);
    }
}
