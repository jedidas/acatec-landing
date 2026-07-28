<?php

namespace App\Filament\Resources\Images\Schemas;

use App\Models\Product;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class ImageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                    ->label("Producto")
                    ->columnSpan('full')
                    ->options(function () {
                        $return = [];
                        $results = Product::with('category')
                            ->get()
                            ->map(function ($product) {
                                return [
                                    $product->id,
                                    "{$product->category->name} - {$product->name}"
                                ];
                            })
                            ->toArray();
                        foreach ($results as $item) {
                            $return[$item[0]] = $item[1];
                        }
                        return $return;
                    })
                    ->searchable()
                    ->required(),
                FileUpload::make('image')
                    ->label('Imagen')
                    ->columnSpan('full')
                    ->disk('public')
                    ->directory('uploads/images')
                    ->image()
                    ->imageEditor()
                    ->automaticallyResizeImagesMode('cover')
                    ->automaticallyCropImagesToAspectRatio('16:12')
                    ->automaticallyResizeImagesToWidth('1000')
                    ->automaticallyResizeImagesToHeight('750')
                    ->imageEditorMode(2)
                    ->visibility('public')
                    ->required()
                    ->maxSize(24000)
                    ->rules(['mimes:jpg,jpeg,png', 'max:24000']),
            ]);
    }
}
