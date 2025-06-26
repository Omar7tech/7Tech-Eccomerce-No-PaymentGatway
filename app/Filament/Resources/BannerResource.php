<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BannerResource\Pages;
use App\Models\Banner;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

class BannerResource extends Resource
{
    protected static ?string $model = Banner::class;

    protected static ?string $navigationIcon = 'heroicon-s-photo';
    protected static ?string $navigationGroup = 'Marketing';
    protected static ?string $navigationLabel = 'Banners';
    protected static ?string $label = 'Banner';
    protected static ?string $pluralLabel = 'Banners';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()
                    ->schema([
                        TextInput::make('title')
                            ->label('Title')
                            ->placeholder('Enter banner title')
                            ->maxLength(255)
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('description')
                            ->label('Description')
                            ->placeholder('Enter banner description')
                            ->maxLength(255)
                            ->columnSpanFull(),

                        FileUpload::make('image_url')
                            ->label('Banner Image')
                            ->image()
                            ->imageEditor()
                            ->directory('banners')
                            ->required()
                            ->lazy()
                            ->columnSpanFull()->enableOpen()
                            ->enableDownload()
                            ->deleteUploadedFileUsing(function ($file) {
                                Storage::disk('public')->delete($file);
                            }),

                        TextInput::make('link_url')
                            ->label('Link URL')
                            ->placeholder('https://example.com')
                            ->url()
                            ->columnSpanFull(),

                        Toggle::make('is_active')
                            ->label('Active')
                            ->default(true),
                    ])
                    ->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\Layout\Stack::make([
                    Tables\Columns\ImageColumn::make('image_url')
                        ->label('Banner')
                        ->disk('public')
                    ,


                    Tables\Columns\TextColumn::make('title')
                        ->label('Title')
                        ->weight('bold')
                        ->limit(30),

                    Tables\Columns\TextColumn::make('description')
                        ->label('Description')
                        ->limit(50)
                        ->tooltip('Click to view full description'),


                    Tables\Columns\ToggleColumn::make('is_active')
                        ->label('Active')
                        ->onColor('success')
                        ->offColor('danger'),
                ]),
            ])->RecordUrl("")
            ->contentGrid([
                'md' => 2, // 2 columns on medium screens
                'xl' => 3, // 3 columns on extra large screens
            ])
            ->defaultSort('order', 'asc')
            ->reorderable('order')
            ->paginated(false)
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);

    }


    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBanners::route('/'),
            'create' => Pages\CreateBanner::route('/create'),
            'edit' => Pages\EditBanner::route('/{record}/edit'),
        ];
    }
}
