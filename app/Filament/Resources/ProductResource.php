<?php

namespace App\Filament\Resources;

use App\Filament\Exports\ProductExporter;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers\ImagesRelationManager;
use App\Models\Product;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\CursorPaginator;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Store';
    protected static ?string $navigationLabel = 'Products';
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::count() == 0 ? 'error' : 'success';
    }




    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->description('Provide the basic details about the product.')
                    ->icon('heroicon-o-information-circle')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Product Name')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g. iPhone 15 Pro, Cotton T-shirt...')
                            ->prefixIcon('heroicon-o-tag')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->required()
                            ->minLength(10)
                            ->maxLength(1000)
                            ->autosize()
                            ->placeholder('Write a short description about the product features...')
                            ->helperText('Minimum 10 characters')
                            ->columnSpanFull(),

                        Forms\Components\MarkdownEditor::make('brief_description')
                            ->label('Brief Description')
                            ->fileAttachmentsDirectory('attachments')
                            ->placeholder('Write A brief description about the product features...')
                            ->disableToolbarButtons([
                                'attachFiles'
                            ])->columnSpanFull(),

                    ]),

                Forms\Components\Section::make('Pricing & Inventory')
                    ->icon('heroicon-o-currency-dollar')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\Select::make('category_id')
                                ->label('Category')
                                ->relationship('category', 'name')
                                ->required()
                                ->searchable()
                                ->preload()
                                ->native(false)
                                ->placeholder('Select Category')
                                ->prefixIcon('heroicon-o-rectangle-stack'),

                            Forms\Components\TextInput::make('price')
                                ->label('Price (USD)')
                                ->required()
                                ->numeric()
                                ->minValue(0.01)
                                ->step(0.01)
                                ->prefix('$')
                                ->placeholder('e.g. 19.99'),
                            Forms\Components\TextInput::make('sale_price')
                                ->label('Sale Price (USD)')
                                ->nullable()
                                ->numeric()
                                ->minValue(0.01)
                                ->step(0.01)
                                ->prefix('$')
                                ->placeholder('e.g. 15.99')
                                ->live(), // 👈 ADD THIS

                        ]),

                        Forms\Components\Grid::make(3)->schema([
                            Forms\Components\TextInput::make('stock')
                                ->label('Stock Quantity')
                                ->required()
                                ->numeric()
                                ->minValue(0)
                                ->suffixIcon('heroicon-o-archive-box')
                                ->placeholder('e.g. 100'),

                            Forms\Components\TextInput::make('sku')
                                ->label('SKU')
                                ->nullable()
                                ->maxLength(50)
                                ->placeholder('Stock Keeping Unit'),

                            Forms\Components\TextInput::make('barcode')
                                ->label('Barcode')
                                ->nullable()
                                ->maxLength(50)
                                ->placeholder('e.g. 0123456789'),
                        ]),
                    ]),

                Forms\Components\Section::make('Product Dimensions')

                    ->collapsible()
                    ->schema([
                        Forms\Components\Grid::make(4)->schema([
                            Forms\Components\TextInput::make('weight')
                                ->label('Weight (kg)')
                                ->numeric()
                                ->placeholder('e.g. 1.25'),

                            Forms\Components\TextInput::make('width')
                                ->label('Width (cm)')
                                ->numeric()
                                ->placeholder('e.g. 15.5'),

                            Forms\Components\TextInput::make('height')
                                ->label('Height (cm)')
                                ->numeric()
                                ->placeholder('e.g. 10.0'),

                            Forms\Components\TextInput::make('depth')
                                ->label('Depth (cm)')
                                ->numeric()
                                ->placeholder('e.g. 2.5'),
                        ]),
                    ]),

                Forms\Components\Section::make('Settings & Tags')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\Toggle::make('is_active')
                                ->label('Active')
                                ->default(true)
                                ->onColor('success')
                                ->offColor('danger'),

                            Forms\Components\Toggle::make('is_featured')
                                ->label('Featured')
                                ->default(false),

                            Forms\Components\Toggle::make('is_new')
                                ->label('New Arrival')
                                ->default(false),

                            Forms\Components\Toggle::make('is_on_sale')
                                ->label('On Sale')
                                ->default(false)->disabled(fn(Forms\Get $get) => empty($get('sale_price')))
                                ->helperText('Enable this if the product is on sale'),
                        ]),

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
                            ->helperText('Add tags for easier searching and filtering.'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->groups([
                Tables\Grouping\Group::make('category.name')
                    ->collapsible(),
            ])->groupingSettingsInDropdownOnDesktop()
            ->columns([
                Tables\Columns\ImageColumn::make('images.image_path')
                    ->label('Images')
                    ->stacked()
                    ->circular()
                    ->limit(3)->limitedRemainingText()

                    ->placeholder('No Images')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable()
                    ->wrap()
                    ->toggleable(false), // Always visible

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable()
                    ->toggleable(false), // Always visible

                Tables\Columns\TagsColumn::make('tags.name')
                    ->label('Tags')
                    ->limit(2)
                    ->color('gray')
                    ->placeholder('No Tags')
                    ->toggleable(false), // Always visible

                Tables\Columns\TextColumn::make('price')
                    ->label('Price')
                    ->sortable()
                    ->money('USD')
                    ->toggleable(false), // Always visible

                Tables\Columns\TextColumn::make('sale_price')
                    ->label('Sale Price')
                    ->money('USD')
                    ->sortable()
                    ->placeholder('No Sale')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock')
                    ->sortable()
                    ->alignCenter()
                    ->toggleable(false)
                    ->extraAttributes(['class' => 'cursor-pointer underline text-primary-500 hover:text-primary-600'])
                    ->tooltip('Click to adjust stock')
                    ->action(
                        Tables\Actions\Action::make('adjustStock')
                            ->label('Adjust Stock')
                            ->modalHeading(fn(Product $record) => "Adjust stock for {$record->name}")
                            ->modalSubmitActionLabel('Update')
                            ->form([
                                Forms\Components\Placeholder::make('current_stock')
                                    ->label('Current Stock')
                                    ->content(fn(Product $record): string => $record->stock),

                                Forms\Components\Radio::make('action')
                                    ->label('Action')
                                    ->options([
                                        'add' => 'Add to stock',
                                        'subtract' => 'Subtract from stock',
                                        'set' => 'Set exact value',
                                    ])
                                    ->default('add')
                                    ->required()
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
                            ->action(function (Product $record, array $data) {
                                $originalStock = $record->stock;

                                switch ($data['action']) {
                                    case 'add':
                                        $record->stock += $data['amount'];
                                        break;
                                    case 'subtract':
                                        $record->stock = max(0, $record->stock - $data['amount']);
                                        break;
                                    case 'set':
                                        $record->stock = $data['new_value'];
                                        break;
                                }

                                $record->save();


                            })
                            ->after(function () {
                                Notification::make()
                                    ->title('Stock updated successfully')
                                    ->success()
                                    ->send();
                            })
                    ),

                Tables\Columns\ToggleColumn::make('is_active')
                    ->label('Active')
                    ->sortable()
                    ->onColor('success')
                    ->offColor('danger')
                    ->toggleable(false), // Always visible

                Tables\Columns\ToggleColumn::make('is_featured')
                    ->label('Featured')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Hidden

                Tables\Columns\ToggleColumn::make('is_new')
                    ->label('New')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Hidden

                Tables\Columns\ToggleColumn::make('is_on_sale')
                    ->label('On Sale')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Hidden

                Tables\Columns\TextColumn::make('sku')
                    ->label('SKU')
                    ->searchable()
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true), // Hidden

                Tables\Columns\TextColumn::make('barcode')
                    ->label('Barcode')
                    ->searchable()
                    ->copyable()
                    ->toggleable(isToggledHiddenByDefault: true), // Hidden

                Tables\Columns\TextColumn::make('weight')
                    ->label('Weight (kg)')
                    ->numeric()
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true), // Hidden

                Tables\Columns\TextColumn::make('width')
                    ->label('Width (cm)')
                    ->numeric()
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true), // Hidden

                Tables\Columns\TextColumn::make('height')
                    ->label('Height (cm)')
                    ->numeric()
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true), // Hidden

                Tables\Columns\TextColumn::make('depth')
                    ->label('Depth (cm)')
                    ->numeric()
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true), // Hidden

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true), // Hidden
            ])
            ->defaultSort('sort', 'asc') // optional
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->label('Category'),

                Tables\Filters\SelectFilter::make('tags')
                    ->relationship('tags', 'name')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->label('Tags'),


                Tables\Filters\Filter::make('stock')
                    ->form([
                        Forms\Components\TextInput::make('min_stock')
                            ->label('Min Stock')
                            ->numeric()
                            ->placeholder('0'),

                        Forms\Components\TextInput::make('max_stock')
                            ->label('Max Stock')
                            ->numeric()
                            ->placeholder('1000'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['min_stock'], fn($q, $min) => $q->where('stock', '>=', $min))
                            ->when($data['max_stock'], fn($q, $max) => $q->where('stock', '<=', $max));
                    })
                    ->label('Stock Range'),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Created From'),

                        Forms\Components\DatePicker::make('created_until')
                            ->label('Created Until'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when($data['created_from'], fn($q, $from) => $q->whereDate('created_at', '>=', $from))
                            ->when($data['created_until'], fn($q, $until) => $q->whereDate('created_at', '<=', $until));
                    })
                    ->label('Created Date'),

                Tables\Filters\Filter::make('sku')
                    ->form([
                        Forms\Components\TextInput::make('sku')
                            ->label('SKU')
                            ->placeholder('Enter SKU'),
                    ])
                    ->query(
                        fn($query, array $data) =>
                        $query->when($data['sku'], fn($q, $sku) => $q->where('sku', 'like', "%{$sku}%"))
                    )
                    ->label('SKU'),

                Tables\Filters\Filter::make('barcode')
                    ->form([
                        Forms\Components\TextInput::make('barcode')
                            ->label('Barcode')
                            ->placeholder('Enter Barcode'),
                    ])
                    ->query(
                        fn($query, array $data) =>
                        $query->when($data['barcode'], fn($q, $barcode) => $q->where('barcode', 'like', "%{$barcode}%"))
                    )
                    ->label('Barcode'),
            ], layout: Tables\Enums\FiltersLayout::AboveContentCollapsible)
            ->deferFilters()
            ->filtersTriggerAction(
                fn(Tables\Actions\Action $action) => $action
                    ->button()
                    ->label('Filter'),
            )
            ->actions([
                Tables\Actions\ViewAction::make()
                    ->icon('heroicon-o-eye')
                    ->label(''),

                Tables\Actions\EditAction::make(),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([

                    Tables\Actions\ExportAction::make()
                        ->exporter(ProductExporter::class)->formats([
                                ExportFormat::Csv,
                                ExportFormat::Xlsx,
                            ])
                ]),
            ])->headerActions([
                    Tables\Actions\ExportAction::make()
                        ->exporter(ProductExporter::class)
                ])
            ->paginated([10, 25, 50, 100, 'all'])->extremePaginationLinks()->deferLoading()
            ->recordClasses(fn(Product $record) => match ($record->is_active) {
                true => 'border-s-2 border-green-600 dark:border-green-300',  // Active = green
                false => 'border-s-2 border-orange-600 dark:border-orange-300', // Inactive = orange
                default => null,
            });
    }


    public static function getRelations(): array
    {
        return [
            ImagesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
