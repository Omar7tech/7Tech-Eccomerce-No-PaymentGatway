<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

use Illuminate\Support\Facades\Storage;


class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';
    protected static ?string $navigationGroup = 'Marketing';
    protected static ?string $navigationLabel = 'Testimonials';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Customer Information')
                    ->description('Enter the customer details and their testimonial')
                    ->icon('heroicon-o-user-circle')
                    ->schema([
                        Forms\Components\Grid::make(3)
                            ->schema([
                                Forms\Components\TextInput::make('name')
                                    ->label('Customer Name')
                                    ->placeholder('Enter customer full name')
                                    ->required()
                                    ->maxLength(255)
                                    ->prefixIcon('heroicon-o-user')
                                    ->columnSpan(2),

                                Forms\Components\FileUpload::make('image')
                                    ->label('Profile Photo')
                                    ->image()
                                    ->imageEditor()
                                    ->imageEditorAspectRatios([
                                        '1:1',
                                    ])
                                    ->deleteUploadedFileUsing(function ($file) {
                                        Storage::disk('public')->delete($file);
                                    })
                                    ->directory('testimonials')
                                    ->maxSize(2048)
                                    ->nullable()
                                    ->helperText('Upload a square image for best results (max 2MB)')
                                    ->columnSpan(1),

                                Forms\Components\Toggle::make('active')
                                    ->label('Active')
                                    ->helperText('Show or hide this testimonial')
                                    ->default(true)
                                    ->columnSpan(2),
                            ]),
                    ]),

                Forms\Components\Section::make('Testimonial Content')
                    ->description('Add the customer testimonial message')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->schema([
                        Forms\Components\Textarea::make('content')
                            ->label('Testimonial Message')
                            ->placeholder('Enter the customer testimonial...')
                            ->required()
                            ->maxLength(1000)
                            ->rows(5)
                            ->helperText('Maximum 1000 characters')
                            ->columnSpanFull(),
                    ]),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->circular()
                    ->size(50)
                    ->defaultImageUrl('https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-6.png')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('content')
                    ->limit(100)
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\ToggleColumn::make('active')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('sort')
                    ->sortable()
                    ->badge()
                    ->color('gray')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('Active')
                    ->query(fn(Builder $query): Builder => $query->where('active', true))
                    ->toggle(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->before(function (Testimonial $record) {
                        if ($record->image) {
                            Storage::disk('public')->delete($record->image);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->before(function ($records) {
                            $records->each(function (Testimonial $record) {
                                if ($record->image) {
                                    Storage::disk('public')->delete($record->image);
                                }
                            });
                        }),
                ]),
            ])
            ->defaultSort('sort', 'asc')
            ->reorderable('sort')
            ->striped()
            ->deferLoading();
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }




}
