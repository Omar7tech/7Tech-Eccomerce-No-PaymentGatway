<?php

namespace App\Filament\Pages;

use App\Settings\AboutPageSettings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;

class ManageAboutPage extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationLabel = 'About Page Settings';
    protected static ?string $title = 'About Page Settings';

    protected static string $settings = AboutPageSettings::class;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('About Page Configuration')
                    ->description('Manage your about page settings and content')
                    ->schema([
                        Forms\Components\Toggle::make('active')
                            ->label('Enable About Page')
                            ->helperText('Toggle to show/hide the about page on your website')
                            ->default(true)
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('title')
                            ->label('Page Title')
                            ->placeholder('About Us')
                            ->maxLength(255)
                            ->helperText('The title that will be displayed on the about page')
                            ->columnSpanFull(),

                        Forms\Components\RichEditor::make('content')
                            ->label('Page Content')
                            ->placeholder('Write about your company, mission, values...')
                            ->helperText('The main content of your about page. You can use rich text formatting.')
                            ->fileAttachmentsDirectory('settings/AboutPageAttachments')
                            ->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
