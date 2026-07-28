<?php

namespace App\Filament\Resources\Products\RelationManagers;

use App\Models\Product;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ImagesRelationManager extends RelationManager
{
    protected static string $relationship = 'images';
    protected static ?string $title = 'Imágenes';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                Hidden::make('product_id'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Image')
            ->columns([
                TextColumn::make('product_id')
                    ->label('Producto')
                    ->formatStateUsing(function (int $state) {
                        $product = Product::with(['category'])->find($state);
                        return "{$product->category->name} / {$product->name}";
                    })
                    ->sortable()->searchable(),
                ImageColumn::make('image')
                    ->label('Imagen')
                    ->disk('public')
                    ->visibility('public'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
