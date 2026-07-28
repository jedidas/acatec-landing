<?php

namespace App\Filament\Resources\Products\Tables;

use App\Models\Category;
use App\Models\Product;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\QueryBuilder\Constraints\NumberConstraint;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('#')
                    ->sortable()
                    ->searchable(),
                ImageColumn::make('image')
                    ->label('Imagen')
                    ->disk('public')
                    ->visibility('public'),
                TextColumn::make('name')
                    ->label('Nombre')
                    ->sortable()->searchable(),
                TextColumn::make('category_id')
                    ->label('Categoria')
                    ->formatStateUsing(function (int $state) {
                        $category = Category::find($state);
                        return $category->name;
                    })
                    ->sortable()->searchable(),
                TextColumn::make('code')
                    ->label('Código')->sortable()
                    ->searchable(),
                TextColumn::make('price')
                    ->label('Precio')
                    ->money('crc')
                    ->icon(Heroicon::CircleStack)
                    ->iconPosition(IconPosition::Before)
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean()
                    ->sortable(),
                IconColumn::make('is_featured')
                    ->label('Destacado')
                    ->boolean()
                    ->sortable(),
                IconColumn::make('has_price')
                    ->label('Mostrar precio')
                    ->boolean()
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_active')
                    ->label('Activo'),
                TernaryFilter::make('is_featured')
                    ->label('Destacado'),
                TernaryFilter::make('has_price')
                    ->label('Mostrar precio'),
                Filter::make('price')
                    ->schema([
                        TextInput::make('price_from')
                            ->numeric()
                            ->minValue(0)
                            ->label('Desde'),
                        TextInput::make('price_until')
                            ->numeric()
                            ->minValue(0)
                            ->label('Hasta'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['price_from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('price', '>=', $date),
                            )
                            ->when(
                                $data['price_until'],
                                fn(Builder $query, $date): Builder => $query->whereDate('price', '<=', $date),
                            );
                    })
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('Ver producto')
                    ->icon('heroicon-o-link')
                    ->url(function (Product $record): string {
                        $product = Product::with('category')->find($record->id);

                        return  route('product.detail', [
                            'categorySlug' => $product->category->slug,
                            'productSlug' => $product->slug,
                        ]);
                    })
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
