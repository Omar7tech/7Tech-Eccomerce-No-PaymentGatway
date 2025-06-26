<?php

namespace App\Filament\Exports;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\CellVerticalAlignment;
use OpenSpout\Common\Entity\Style\Color;
use OpenSpout\Common\Entity\Style\Style;
use App\Models\Product;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;


class ProductExporter extends Exporter
{
    protected static ?string $model = Product::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),

            ExportColumn::make('name'),
            ExportColumn::make('category.name')
                ->label('Category Name'),
            ExportColumn::make('tags.name')->separator(',')
                ->label('Tags'),
            ExportColumn::make('slug'),
            ExportColumn::make('weight'),
            ExportColumn::make('width'),
            ExportColumn::make('height'),
            ExportColumn::make('depth'),
            ExportColumn::make('description'),
            ExportColumn::make('price'),
            ExportColumn::make('stock'),
            ExportColumn::make('sort'),
            ExportColumn::make('sku')
                ->label('SKU'),
            ExportColumn::make('barcode'),
            ExportColumn::make('is_active')->getStateUsing(function (Product $record) {
                return $record->is_active ? 'Yes' : 'No';
            }),
            ExportColumn::make('is_featured')->getStateUsing(function (Product $record) {
                return $record->is_active ? 'Yes' : 'No';
            }),
            ExportColumn::make('is_new')->getStateUsing(function (Product $record) {
                return $record->is_active ? 'Yes' : 'No';
            }),
            ExportColumn::make('is_on_sale')->getStateUsing(function (Product $record) {
                return $record->is_active ? 'Yes' : 'No';
            }),
            ExportColumn::make('sale_price'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your product export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }

    public static function getCompletedNotificationTitle(Export $export): string
    {
        return 'Product export completed';
    }
    public static function getFailedNotificationTitle(Export $export): string
    {
        return 'Product export failed';
    }
    public static function getFailedNotificationBody(Export $export): string
    {
        return 'Your product export has failed. Please try again.';
    }
    public static function getExportedNotificationTitle(Export $export): string
    {
        return 'Product export ready';
    }
    public function getXlsxCellStyle(): ?Style
    {
        return (new Style())
            ->setFontBold()
            ->setFontItalic()
            ->setFontSize(14)
            ->setFontName('Consolas')
            ->setCellAlignment(CellAlignment::CENTER)
            ->setCellVerticalAlignment(CellVerticalAlignment::CENTER);

    }

}
