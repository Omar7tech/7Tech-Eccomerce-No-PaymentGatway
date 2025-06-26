<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';
    protected static ?string $title = 'Product Images';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image_path')
                ->label('Upload Images')
                    ->helperText('Upload product images. You can upload multiple images at once.')

                    ->image()
                    ->panelLayout('grid')
                    ->openable()
                    ->multiple()
                    ->directory('product-images')
                    ->disk('public')

                    ->imageEditor()
                    ->imageEditorMode(1)
                    ->required()
                    ->columnSpanFull()
                    ->imagePreviewHeight('200'),
            ]);
    }

    public function table(Table $table): Table
{
    return $table
        ->recordTitleAttribute('image_path')
        ->columns([
            Tables\Columns\Layout\Stack::make([
                Tables\Columns\ImageColumn::make('image_path')
                    ->disk('public')
                    ->label('Image')
                    ->square()->size(200),
            ]),
        ])
        ->contentGrid([
            'md' => 2,
            'xl' => 3,
        ])
        ->headerActions([
            Tables\Actions\CreateAction::make()
                ->using(fn (array $data, RelationManager $livewire) => collect($data['image_path'])
                    ->map(fn ($image) => $livewire->getRelationship()->create([
                        'image_path' => $image,
                    ]))
                    ->first() // Return the first created record
                ),
        ])
        ->actions([
            Tables\Actions\DeleteAction::make(),
        ])
        ->defaultSort('sort', 'asc')
        ->reorderable('sort')
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                Tables\Actions\DeleteBulkAction::make(),
            ]),
        ]);
}

}
