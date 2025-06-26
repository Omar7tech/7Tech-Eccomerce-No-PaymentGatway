<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductStockResource\Pages;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Table;

class ProductStockResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationGroup = 'Store';
    protected static ?string $navigationLabel = 'Product Stock';
    protected static ?string $label = 'Stock';
    protected static ?string $pluralLabel = 'Stock';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Stack::make([
                    Tables\Columns\TextColumn::make('name')
                        ->label('Product')
                        ->searchable()
                        ->sortable(),

                    Tables\Columns\TextColumn::make('stock')
                        ->label('Stock')
                        ->sortable()
                        ->alignCenter()
                        ->size('lg')
                        ->weight("bold")
                        ->toggleable(false)
                        ->extraAttributes([
                            'class' => 'cursor-pointer underline text-primary-500 hover:text-primary-600',
                        ])
                        ->tooltip('Click to adjust stock')
                        ->action(
                            Tables\Actions\Action::make('adjustStock')
                                ->label('Adjust Stock')
                                ->modalHeading(fn(Product $record) => "Adjust stock for {$record->name}")
                                ->modalSubmitActionLabel('Update')
                                ->form([
                                    Forms\Components\Card::make([
                                        Forms\Components\Placeholder::make('current_stock')
                                            ->label('Current Stock')
                                            ->content(fn(Product $record): string => (string) $record->stock),

                                        Forms\Components\Radio::make('action')
                                            ->label('Action')
                                            ->options([
                                                'add' => 'Add to stock',
                                                'subtract' => 'Subtract from stock',
                                                'set' => 'Set exact value',
                                            ])
                                            ->default('add')
                                            ->required()
                                            ->inline() // Looks nicer inside a Card
                                            ->reactive(),

                                        Forms\Components\TextInput::make('amount')
                                            ->label('Amount')
                                            ->numeric()
                                            ->required()
                                            ->minValue(1)
                                            ->default(1)
                                            ->visible(fn(Forms\Get $get) => in_array($get('action'), ['add', 'subtract'])),

                                        Forms\Components\TextInput::make('new_value')
                                            ->label('New Stock Value')
                                            ->numeric()
                                            ->required()
                                            ->minValue(0)
                                            ->visible(fn(Forms\Get $get) => $get('action') === 'set'),
                                    ])
                                        ->columns(2)
                                        ->columnSpan('full'),
                                ])
                                ->action(function (Product $record, array $data) {
                                    match ($data['action']) {
                                        'add' => $record->increment('stock', $data['amount']),
                                        'subtract' => $record->decrement('stock', min($record->stock, $data['amount'])),
                                        'set' => $record->update(['stock' => $data['new_value']]),
                                    };
                                })
                                ->after(
                                    fn() => Notification::make()
                                        ->title('Stock updated successfully')
                                        ->success()
                                        ->send()
                                )
                        ),
                ]),
            ])
            ->contentGrid([
                'sm' => 2,
                'md' => 3,
                'xl' => 4,
            ])
            ->actions([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductStocks::route('/'),
        ];
    }
}
