<?php

namespace App\Filament\Pages;

use App\Settings\FooterSettings;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\Select;
use Filament\Support\Enums\IconPosition;

class ManageFooter extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-bars-arrow-down';
    protected static ?string $navigationGroup = 'Settings';
    protected static string $settings = FooterSettings::class;
    protected static ?string $title = 'Footer Management';
    protected static ?string $navigationLabel = 'Footer Settings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Footer Configuration')
                    ->tabs([
                        Tabs\Tab::make('General Settings')
                            ->icon('heroicon-o-cog-6-tooth')
                            ->schema([
                                Section::make('Footer Control')
                                    ->description('Enable or disable the footer and configure its basic appearance')
                                    ->icon('heroicon-o-eye')
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                Toggle::make('footer_enabled')
                                                    ->label('Enable Footer')
                                                    ->helperText('Show or hide the footer across your website')
                                                    ->default(true)
                                                    ->inline(false),

                                                Select::make('footer_style')
                                                    ->label('Footer Style')
                                                    ->options([
                                                        1 => 'Style 1 - Default Layout',
                                                        2 => 'Style 2 - Compact Layout',
                                                        3 => 'Style 3 - Centered Layout',
                                                    ])
                                                    ->default(1)
                                                    ->required()
                                                    ->selectablePlaceholder(false)
                                                    ->native(false),
                                            ]),
                                    ]),

                                Section::make('Footer Content')
                                    ->description('Configure the main text content of your footer')
                                    ->icon('heroicon-o-document-text')
                                    ->schema([
                                        RichEditor::make('footer_text')
                                            ->label('Footer Text')
                                            ->helperText('Rich text content for your footer. Supports formatting, links, and basic HTML.')
                                            ->required()
                                            ->toolbarButtons([
                                                'bold',
                                                'italic',
                                                'underline',
                                                'link',
                                                'bulletList',
                                                'orderedList',
                                            ])
                                            ->columnSpanFull(),
                                    ]),
                            ]),

                        Tabs\Tab::make('Navigation & Links')
                            ->icon('heroicon-o-link')
                            ->schema([
                                Section::make('Quick Links')
                                    ->description('Add important navigation links to your footer')
                                    ->icon('heroicon-o-cursor-arrow-rays')
                                    ->schema([
                                        Repeater::make('footer_links')
                                            ->label('')
                                            ->schema([
                                                Grid::make(2)
                                                    ->schema([
                                                        TextInput::make('label')
                                                            ->label('Link Label')
                                                            ->placeholder('e.g., About Us')
                                                            ->required()
                                                            ->maxLength(50),

                                                        TextInput::make('url')
                                                            ->label('Link URL')
                                                            ->placeholder('https://example.com/about')

                                                            ->required()
                                                            ->suffixIcon('heroicon-o-link')
                                                            ->suffixIconColor('primary'),
                                                    ]),
                                            ])
                                            ->itemLabel(fn(array $state): ?string => $state['label'] ?? 'New Link')
                                            ->addActionLabel('Add Quick Link')
                                            ->defaultItems(0)
                                            ->reorderable()
                                            ->collapsible()
                                            ->cloneable()
                                            ->deleteAction(
                                                fn($action) => $action->requiresConfirmation()
                                            ),
                                    ]),
                            ]),

                        Tabs\Tab::make('Social Media')
                            ->icon('heroicon-o-share')
                            ->schema([
                                Section::make('Social Media Profiles')
                                    ->description('Connect your social media accounts to the footer')
                                    ->icon('heroicon-o-hashtag')
                                    ->schema([
                                        Repeater::make('footer_socials')
                                            ->label('')
                                            ->schema([
                                                Grid::make(3)
                                                    ->schema([
                                                        Select::make('platform')
                                                            ->label('Platform')
                                                            ->options([
                                                                'facebook' => 'Facebook',
                                                                'twitter' => 'Twitter/X',
                                                                'instagram' => 'Instagram',
                                                                'linkedin' => 'LinkedIn',
                                                                'youtube' => 'YouTube',
                                                                'tiktok' => 'TikTok',
                                                                'pinterest' => 'Pinterest',
                                                                'discord' => 'Discord',
                                                                'telegram' => 'Telegram',
                                                                'whatsapp' => 'WhatsApp',
                                                                'other' => 'Other',
                                                            ])
                                                            ->required()
                                                            ->searchable()
                                                            ->native(false),

                                                        TextInput::make('url')
                                                            ->label('Profile URL')
                                                            ->placeholder('https://facebook.com/yourpage')
                                                            ->url()
                                                            ->required()
                                                            ->suffixIcon('heroicon-o-link')
                                                            ->columnSpan(2),
                                                    ]),

                                                TextInput::make('icon_url')
                                                    ->label('Custom Icon URL (Optional)')
                                                    ->placeholder('https://example.com/custom-icon.png')
                                                    ->helperText('Leave empty to use default platform icon')

                                                    ->suffixIcon('heroicon-o-photo')
                                                    ->columnSpanFull(),
                                            ])
                                            ->itemLabel(
                                                fn(array $state): ?string =>
                                                isset($state['platform']) ? ucfirst($state['platform']) : 'Social Link'
                                            )
                                            ->addActionLabel('Add Social Media')
                                            ->defaultItems(0)
                                            ->reorderable()
                                            ->collapsible()
                                            ->cloneable()
                                            ->deleteAction(
                                                fn($action) => $action->requiresConfirmation()
                                            ),
                                    ]),
                            ]),

                        Tabs\Tab::make('Contact Information')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Grid::make(2)
                                    ->schema([
                                        Section::make('Phone Numbers')
                                            ->description('Add contact phone numbers')
                                            ->icon('heroicon-o-phone')
                                            ->schema([
                                                Repeater::make('footer_phones')
                                                    ->label('')
                                                    ->schema([
                                                        TextInput::make('number')
                                                            ->label('Phone Number')
                                                            ->placeholder('+1 (555) 123-4567')
                                                            ->required()
                                                            ->tel()
                                                            ->prefixIcon('heroicon-o-phone')
                                                            ->prefixIconColor('success'),
                                                    ])
                                                    ->itemLabel(fn(array $state): ?string => $state['number'] ?? 'Phone Number')
                                                    ->addActionLabel('Add Phone')
                                                    ->defaultItems(0)
                                                    ->reorderable(),
                                            ]),

                                        Section::make('Email Addresses')
                                            ->description('Add contact email addresses')
                                            ->icon('heroicon-o-envelope')
                                            ->schema([
                                                Repeater::make('footer_emails')
                                                    ->label('')
                                                    ->schema([
                                                        TextInput::make('address')
                                                            ->label('Email Address')
                                                            ->placeholder('contact@example.com')
                                                            ->required()
                                                            ->email()
                                                            ->prefixIcon('heroicon-o-envelope')
                                                            ->prefixIconColor('primary'),
                                                    ])
                                                    ->itemLabel(fn(array $state): ?string => $state['address'] ?? 'Email Address')
                                                    ->addActionLabel('Add Email')
                                                    ->defaultItems(0)
                                                    ->reorderable(),
                                            ]),
                                    ]),

                                Section::make('Locations')
                                    ->description('Add physical location information with map links')
                                    ->icon('heroicon-o-map-pin')
                                    ->schema([
                                        Repeater::make('footer_locations')
                                            ->label('')
                                            ->schema([
                                                Grid::make(2)
                                                    ->schema([
                                                        TextInput::make('name')
                                                            ->label('Location Name')
                                                            ->placeholder('e.g., Main Office, New York Store')
                                                            ->required()
                                                            ->prefixIcon('heroicon-o-building-office')
                                                            ->maxLength(100),

                                                        TextInput::make('url')
                                                            ->label('Map URL')
                                                            ->placeholder('https://maps.google.com/...')
                                                            ->url()
                                                            ->required()
                                                            ->suffixIcon('heroicon-o-map')
                                                            ->suffixIconColor('success'),
                                                    ]),
                                            ])
                                            ->itemLabel(fn(array $state): ?string => $state['name'] ?? 'Location')
                                            ->addActionLabel('Add Location')
                                            ->defaultItems(0)
                                            ->reorderable()
                                            ->collapsible()
                                            ->cloneable()
                                            ->deleteAction(
                                                fn($action) => $action->requiresConfirmation()
                                            ),
                                    ]),
                            ]),
                    ])
                    ->columnSpanFull()
                    ->persistTabInQueryString()
            ]);
    }

    public function getTitle(): string
    {
        return 'Footer Management';
    }

    protected function getHeaderActions(): array
    {
        return [
            // You can add header actions here if needed
        ];
    }
}
