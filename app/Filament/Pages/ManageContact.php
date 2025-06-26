<?php

namespace App\Filament\Pages;

use App\Settings\ContactSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Forms\Get;
use Illuminate\Support\HtmlString;

class ManageContact extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-phone';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'Contact Settings';
    protected static ?string $title = 'Contact Settings';
    protected static string $settings = ContactSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Contact Badge Design Section
                Forms\Components\Section::make()
                    ->heading('Contact Badge Design')
                    ->description('Choose the style and position of your contact widget')
                    ->icon('heroicon-o-paint-brush')
                    ->schema([
                        Forms\Components\Grid::make(1)
                            ->schema([
                                Forms\Components\Radio::make('contact_design')
                                    ->label('Design & Position')
                                    ->options([
                                        1 => 'Design 1 (Left Side) - Classic floating button',
                                        2 => 'Design 2 (Left Side) - Modern card style',
                                        3 => 'Design 3 (Right Side) - Compact minimal',
                                    ])
                                    ->descriptions([
                                        1 => 'Traditional floating contact button positioned on the left side of the screen',
                                        2 => 'Modern card-style contact widget positioned on the left side of the screen',
                                        3 => 'Compact minimal design positioned on the right side of the screen',
                                    ])
                                    ->default(1)
                                    ->required()
                                    ->columnSpanFull(),

                                Forms\Components\Placeholder::make('tawk_warning')
                                    ->content(new HtmlString('<div style="color:#b45309;font-weight:bold;">⚠️ Tawk Customer Service Conflict Warning</div><div>Design 3 is positioned on the <b>right</b> side of the screen. If you\'re using Tawk customer service (which also appears on the right), avoid selecting Design 3 to prevent overlapping widgets and user confusion. Choose Design 1 or 2 instead.</div>'))
                                    ->visible(fn(Get $get): bool => $get('contact_design') == 3)
                                    ->columnSpanFull(),

                                Forms\Components\Placeholder::make('tawk_safe')
                                    ->content(new HtmlString('<div style="color:#15803d;font-weight:bold;">✅ Tawk Compatible</div><div>This design is positioned on the <b>left</b> side and won\'t conflict with Tawk customer service on the right.</div>'))
                                    ->visible(fn(Get $get): bool => in_array($get('contact_design'), [1, 2]))
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->collapsible()
                    ->persistCollapsed(),

                // Master Toggle Section
                Forms\Components\Section::make()
                    ->heading('Contact Section Control')
                    ->description('Enable or disable the entire contact section')
                    ->icon('heroicon-o-power')
                    ->schema([
                        Forms\Components\Toggle::make('contact_enabled')
                            ->label('Enable Contact Section')
                            ->helperText('Toggle to show or hide the entire contact section on your website')
                            ->default(false)
                            ->live()
                            ->inline(false)
                            ->columnSpanFull(),

                        Forms\Components\Placeholder::make('contact_disabled_warning')
                            ->content(new HtmlString('<div style="color:#b91c1c;font-weight:bold;">Contact Section Disabled</div><div>The contact section is currently disabled. Enable it above to configure contact methods.</div>'))
                            ->visible(fn(Get $get): bool => !$get('contact_enabled'))
                            ->columnSpanFull(),
                    ]),

                // Contact Methods Section
                Forms\Components\Section::make()
                    ->heading('Contact Methods')
                    ->description('Configure how customers can reach you')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->headerActions([
                        Forms\Components\Actions\Action::make('preview')
                            ->label('Preview Changes')
                            ->icon('heroicon-o-eye')
                            ->color('gray')
                            ->size('sm')
                            ->tooltip('Preview how your contact methods will appear')
                    ])
                    ->schema([
                        // WhatsApp Contact Section
                        Forms\Components\Section::make()
                            ->heading('WhatsApp Contact')
                            ->description('Enable WhatsApp for instant messaging support')
                            ->icon('heroicon-o-chat-bubble-bottom-center-text')
                            ->schema([
                                Forms\Components\Grid::make(3)
                                    ->schema([
                                        Forms\Components\Toggle::make('whatsapp_enabled')
                                            ->label('Enable WhatsApp')
                                            ->default(false)
                                            ->live()
                                            ->inline(false)
                                            ->columnSpan(1),

                                        Forms\Components\TextInput::make('whatsapp_number')
                                            ->label('WhatsApp Number')
                                            ->placeholder('+1 234 567 8901')
                                            ->helperText('Include country code (e.g., +1 for US, +44 for UK)')
                                            ->tel()
                                            ->maxLength(30)
                                            ->prefixIcon('heroicon-o-device-phone-mobile')
                                            ->suffixAction(
                                                Forms\Components\Actions\Action::make('test_whatsapp')
                                                    ->label('Test')
                                                    ->icon('heroicon-o-arrow-top-right-on-square')
                                                    ->size('sm')
                                                    ->color('success')
                                                    ->tooltip('Test WhatsApp link')
                                                    ->visible(fn(Get $get): bool => filled($get('whatsapp_number')))
                                                    ->url(fn(Get $get): string => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $get('whatsapp_number')))
                                                    ->openUrlInNewTab()
                                            )
                                            ->disabled(fn(Get $get): bool => !$get('whatsapp_enabled'))
                                            ->columnSpan(2),
                                    ]),
                            ])
                            ->extraAttributes(['class' => 'border-l-4 border-l-green-500 bg-green-50/30'])
                            ->collapsible(),

                        // Phone Contact Section
                        Forms\Components\Section::make()
                            ->heading('Phone Contact')
                            ->description('Enable direct phone calling')
                            ->icon('heroicon-o-phone')
                            ->schema([
                                Forms\Components\Grid::make(3)
                                    ->schema([
                                        Forms\Components\Toggle::make('phone_number_enabled')
                                            ->label('Enable Phone')
                                            ->default(false)
                                            ->live()
                                            ->inline(false)
                                            ->columnSpan(1),

                                        Forms\Components\TextInput::make('phone_number')
                                            ->label('Phone Number')
                                            ->placeholder('+1 234 567 8901')
                                            ->helperText('Include country code for international calls')
                                            ->tel()
                                            ->maxLength(30)
                                            ->prefixIcon('heroicon-o-phone')
                                            ->suffixAction(
                                                Forms\Components\Actions\Action::make('test_phone')
                                                    ->label('Test')
                                                    ->icon('heroicon-o-arrow-top-right-on-square')
                                                    ->size('sm')
                                                    ->color('blue')
                                                    ->tooltip('Test phone link')
                                                    ->visible(fn(Get $get): bool => filled($get('phone_number')))
                                                    ->url(fn(Get $get): string => 'tel:' . $get('phone_number'))
                                            )
                                            ->disabled(fn(Get $get): bool => !$get('phone_number_enabled'))
                                            ->columnSpan(2),
                                    ]),
                            ])
                            ->extraAttributes(['class' => 'border-l-4 border-l-blue-500 bg-blue-50/30'])
                            ->collapsible(),

                        // Email Contact Section
                        Forms\Components\Section::make()
                            ->heading('Email Contact')
                            ->description('Enable email communication')
                            ->icon('heroicon-o-envelope')
                            ->schema([
                                Forms\Components\Grid::make(3)
                                    ->schema([
                                        Forms\Components\Toggle::make('email_enabled')
                                            ->label('Enable Email')
                                            ->default(false)
                                            ->live()
                                            ->inline(false)
                                            ->columnSpan(1),

                                        Forms\Components\TextInput::make('email')
                                            ->label('Email Address')
                                            ->placeholder('contact@example.com')
                                            ->helperText('Use a monitored email address')
                                            ->email()
                                            ->maxLength(255)
                                            ->prefixIcon('heroicon-o-envelope')
                                            ->suffixAction(
                                                Forms\Components\Actions\Action::make('test_email')
                                                    ->label('Test')
                                                    ->icon('heroicon-o-arrow-top-right-on-square')
                                                    ->size('sm')
                                                    ->color('orange')
                                                    ->tooltip('Test email link')
                                                    ->visible(fn(Get $get): bool => filled($get('email')))
                                                    ->url(fn(Get $get): string => 'mailto:' . $get('email'))
                                            )
                                            ->disabled(fn(Get $get): bool => !$get('email_enabled'))
                                            ->columnSpan(2),
                                    ]),
                            ])
                            ->extraAttributes(['class' => 'border-l-4 border-l-orange-500 bg-orange-50/30'])
                            ->collapsible(),

                        // Status Dashboard
                        Forms\Components\Section::make()
                            ->heading('Contact Methods Status')
                            ->schema([
                                Forms\Components\Placeholder::make('status_summary')
                                    ->label('')
                                    ->content(function (Get $get): HtmlString {
                                        $enabled = collect([
                                            $get('whatsapp_enabled') ? '📱 WhatsApp' : null,
                                            $get('phone_number_enabled') ? '📞 Phone' : null,
                                            $get('email_enabled') ? '📧 Email' : null,
                                        ])->filter()->values();

                                        if ($enabled->isEmpty()) {
                                            return new HtmlString('<div class="text-amber-600 font-medium">⚠️ No contact methods are currently enabled</div>');
                                        }

                                        return new HtmlString('<div class="text-green-600 font-medium">✅ Active contact methods: ' . $enabled->join(', ', ' and ') . '</div>');
                                    })
                                    ->columnSpanFull(),
                            ])
                            ->compact(),
                    ])
                    ->visible(fn(Get $get): bool => $get('contact_enabled'))
                    ->collapsible()
                    ->persistCollapsed(),

                // Pro Tips Section
                Forms\Components\Section::make()
                    ->heading('Pro Tips & Best Practices')
                    ->description('Maximize the effectiveness of your contact methods')
                    ->icon('heroicon-o-light-bulb')
                    ->schema([
                        Forms\Components\Placeholder::make('help_text')
                            ->label('')
                            ->content(new HtmlString('💡 <strong>Pro Tips:</strong><ul style="margin-top:8px;list-style:disc;padding-left:20px;">
                                <li><span style="font-size:1.1em">🌍</span> <strong>International Numbers:</strong> Always include country codes in phone numbers (e.g., +1 for US, +44 for UK)</li>
                                <li><span style="font-size:1.1em">🔄</span> <strong>Regular Testing:</strong> Test your contact methods regularly using the test buttons to ensure they work properly</li>
                                <li><span style="font-size:1.1em">⚡</span> <strong>Active Monitoring:</strong> Only enable contact methods you actively monitor and can respond to quickly</li>
                                <li><span style="font-size:1.1em">💬</span> <strong>WhatsApp Advantage:</strong> WhatsApp is excellent for quick customer support and building customer relationships</li>
                                <li><span style="font-size:1.1em">🎯</span> <strong>Tawk Integration:</strong> If using Tawk customer service, choose Design 1 or 2 to avoid right-side conflicts</li>
                            </ul>'))
                            ->columnSpanFull(),
                    ])
                    ->visible(fn(Get $get): bool => $get('contact_enabled'))
                    ->collapsible()
                    ->collapsed(),
            ])
            ->columns(1);
    }
}
