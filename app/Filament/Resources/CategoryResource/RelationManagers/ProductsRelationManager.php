<?php

namespace App\Filament\Resources\CategoryResource\RelationManagers;

use App\Filament\Resources\ProductResource\RelationManagers\ImagesRelationManager;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductsRelationManager extends RelationManager
{
    protected static string $relationship = 'Products';

    public  function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->description('Enter product details')
                    ->icon('heroicon-o-shopping-bag')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Product Name')
                            ->required()
                            ->string()
                            ->maxLength(255)
                            ->placeholder('e.g. iPhone 15 Pro, Cotton T-shirt...')
                            ->prefixIcon('heroicon-o-tag')
                            ->columnSpan(['md' => 2]),

                        Forms\Components\Textarea::make('description')
                            ->label('Product Description')
                            ->required()
                            ->string()
                            ->minLength(10)
                            ->maxLength(1000)
                            ->autosize()
                            ->placeholder('Describe the product features and benefits...')
                            ->helperText('Minimum 10 characters')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Inventory & Pricing')
                    ->icon('heroicon-o-currency-dollar')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->native(false)
                            ->placeholder('Select a category')
                            ->prefixIcon('heroicon-o-rectangle-stack')
                            ->columnSpan(['md' => 2]),

                        Forms\Components\TextInput::make('price')
                            ->label('Price (USD)')
                            ->required()
                            ->numeric()
                            ->minValue(0.01)
                            ->step(0.01)
                            ->prefix('$')
                            ->placeholder('e.g. 19.99')
                            ->suffixIcon('heroicon-o-currency-dollar'),

                        Forms\Components\TextInput::make('stock')
                            ->label('Stock Quantity')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->integer()
                            ->placeholder('e.g. 100')
                            ->suffixIcon('heroicon-o-archive-box'),
                    ])
                    ->columns(['md' => 2]),

                Forms\Components\Section::make('Settings')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Product Status')
                            ->default(true)
                            ->inline(false)
                            ->onColor('success')
                            ->offColor('danger')
                            ->helperText('Active products will be visible to customers'),

                        Forms\Components\Select::make('tags')
                            ->label('Product Tags')
                            ->relationship('tags', 'name')
                            ->multiple()
                            ->preload()
                            ->searchable()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->maxLength(50)
                                    ->unique('tags', 'name'),
                            ])
                            ->placeholder('Select or create tags')
                            ->helperText('Add relevant tags for better discoverability'),
                    ]),
            ])
            ->columns(['md' => 1]);
    }

    public  function table(Table $table): Table
    {
        return $table
        ->reorderable('sort')
        ->defaultSort('sort', 'asc')
            ->columns([
                Tables\Columns\ImageColumn::make('images.image_path')  // Assuming 'images' is the relationship name
                    ->label('Images')
                    ->stacked()
                    ->circular()
                    ->placeholder('No Images')
                ,
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->sortable()
                    ->money('USD'),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Is Active')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')->searchable()
                    ->preload()
                    ->placeholder('Select a category')
                    ->label('Category'),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->url(fn($record) => route('filament.admin.resources.products.edit', $record)),
            ])
            ->bulkActions([

            ]);
    }


}
