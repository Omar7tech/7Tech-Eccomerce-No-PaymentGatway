<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';
    protected static ?string $navigationGroup = 'Store';
    protected static ?string $navigationLabel = 'Categories';


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
                Forms\Components\Section::make('Category Information')
                    ->description('Enter the basic details for this category')
                    ->icon('heroicon-o-tag')
                    ->collapsible()
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->string()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->label('Category Name')
                            ->columnSpanFull()
                            ->prefixIcon('heroicon-o-tag')
                            ->placeholder('e.g. Electronics, Clothing...'),

                        Forms\Components\Textarea::make('description')
                            ->autoSize()
                            ->rules(['nullable', 'string'])
                            ->columnSpanFull()
                            ->label('Category Description')
                            ->placeholder('A brief description of this category'),
                    ]),

                Forms\Components\Section::make('Media')
                    ->description('Upload a representative image for this category')
                    ->icon('heroicon-o-photo')
                    ->collapsible()
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->rules(['nullable', 'image', 'max:1024'])
                            ->disk('public')
                            ->directory('category-images')
                            ->image()
                            ->imageEditor()
                            ->imagePreviewHeight('150')
                            ->panelAspectRatio('2:1')
                            ->panelLayout('integrated')
                            ->uploadingMessage('Uploading category image...')
                            ->enableOpen()
                            ->enableDownload()
                            ->deleteUploadedFileUsing(function ($file) {
                                Storage::disk('public')->delete($file);
                            })

                            ->columnSpanFull()
                            ->label('Category Image'),
                    ]),

                Forms\Components\Section::make('Status')
                    ->description('Control the visibility of this category')
                    ->icon('heroicon-o-eye')
                    ->collapsible()
                    ->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->default(true)
                            ->label('Active Category')
                            ->onColor('success')
                            ->offColor('danger')
                            ->inline(false)
                            ->helperText('Toggle to make this category visible or hidden'),
                    ]),
            ])
            ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Image')->size(50)->defaultImageUrl('https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-6.png')->toggleable(),
                Tables\Columns\TextColumn::make('name')->sortable()->searchable()->weight('bold')->toggleable(),
                Tables\Columns\TextColumn::make('description')->limit(50)->sortable()->searchable()->copyable()->placeholder('No description')->toggleable(),
                Tables\Columns\ToggleColumn::make('is_active')->sortable()->toggleable(),
                Tables\Columns\BadgeColumn::make('products_count')->counts('products')->label('Products')->color(fn($state) => $state > 0 ? 'success' : 'danger')->sortable()->placeholder('No products')->toggleable()->url(fn($record) => $record->products_count > 0
                    ? route(
                        "filament.admin.resources.products.index",
                        ['tableFilters[category][values][0]' => $record->id]
                    )
                    : null),
                Tables\Columns\TextColumn::make('created_at')->since()->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('updated_at')->since()->sortable()->toggleable(),

            ])
            ->filters([
                Tables\Filters\Filter::make('Have Image')
                    ->query(fn(Builder $query): Builder => $query->whereNotNull('image'))->toggle(),
                Tables\Filters\Filter::make('Is Active')
                    ->query(fn(Builder $query): Builder => $query->where('is_active', true))->toggle(),


            ])->defaultSort('sort', 'asc')
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make()->icon('heroicon-o-eye')->label(''),



            ])
            ->bulkActions([

            ])->emptyStateHeading('No Categories yet')
            ->reorderable("sort")
            ->emptyStateDescription('Once you make your first category, it will appear here.')
            ->deferLoading()->striped();
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }


}
