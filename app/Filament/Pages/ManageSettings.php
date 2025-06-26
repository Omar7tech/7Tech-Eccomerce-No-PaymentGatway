<?php
// App/Filament/Pages/ManageSettings.php
namespace App\Filament\Pages;

use App\Settings\GeneralSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;

class ManageSettings extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-cog';
    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'General Settings';
    protected static string $settings = GeneralSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Card for General Site Settings
                Card::make()
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Site Name')
                            ->placeholder('Enter your site name')
                            ->helperText('This name will appear across your website.')
                            ->required()
                            ->maxLength(255)
                            ->columnSpanFull(),

                        Toggle::make('site_active')
                            ->label('Is the Site Active?')
                            ->helperText('Turn off to deactivate the site.')
                            ->required()
                            ->columnSpanFull(),

                        FileUpload::make('site_logo')
                            ->label('Site Logo')
                            ->helperText('Upload your site logo (recommended: PNG/SVG format)')
                            ->image()
                            ->disk('public')
                            ->directory('settings/logos')
                            ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/svg+xml'])
                            ->maxSize(2048) // 2MB max


                            ->columnSpanFull(),

                        FileUpload::make('site_favicon')
                            ->label('Site Favicon')
                            ->helperText('Upload your site favicon (recommended: ICO or PNG format, 32x32px)')
                            ->image()
                            ->disk('public')
                            ->directory('settings/favicons')
                            ->acceptedFileTypes(['image/x-icon', 'image/png', 'image/ico'])
                            ->maxSize(512) // 512KB max
                            ->imageResizeTargetWidth('32')
                            ->imageResizeTargetHeight('32')
                            ->columnSpanFull(),
                    ])
                    ->columns(1) // Card has single column layout
                // You can add more Cards or components here for other settings
            ])
            ->columns(1); // Full width on the form
    }
}
