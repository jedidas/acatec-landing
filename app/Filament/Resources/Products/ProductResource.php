<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Pages\ViewProduct;
use App\Filament\Resources\Products\RelationManagers\ImagesRelationManager;
use App\Filament\Resources\Products\Schemas\ProductForm;
use App\Filament\Resources\Products\Tables\ProductsTable;
use App\Models\Category;
use App\Models\Product;
use BackedEnum;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $label = "Producto";
    protected static ?string $pluralLabel = "Productos";

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'view' => ViewProduct::route('/{record}'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([

            Section::make('Producto')
                ->description('Información general del producto')
                ->schema([

                    ImageEntry::make('image')
                        ->disk('public')
                        ->visibility('public')
                        ->label('Imagen')
                        ->imageSize('400px')
                        ->alignCenter()
                        ->columnSpanFull(),

                    TextEntry::make('name')
                        ->label('Nombre')
                        ->icon(Heroicon::Cube)
                        ->iconPosition(IconPosition::Before)
                        ->iconColor('primary'),

                    TextEntry::make('category.name')
                        ->label('Categoría')
                        ->formatStateUsing(fn($state) => $state ?? '-'),

                    TextEntry::make('code')
                        ->label('Código'),

                    TextEntry::make('price')
                        ->label('Precio')
                        ->formatStateUsing(fn($state) => $state !== null
                            ? (is_numeric($state) ? number_format($state, 2) . ' CRC' : $state)
                            : '-')
                        ->icon(Heroicon::CircleStack)
                        ->iconPosition(IconPosition::Before),

                    RepeatableEntry::make('features')
                        ->label('Características')
                        ->schema([
                            TextEntry::make('name')
                                ->label('Título')
                                ->weight('bold'),

                            TextEntry::make('value')
                                ->label('Texto')
                                ->color('gray'),
                        ])
                        ->columns(2)
                        ->grid(2)
                        ->columnSpanFull()
                        ->visible(fn($record) => !empty($record->features)),

                ])
                ->columns(2)

                ->columnSpanFull(),

            Section::make('Estado')
                ->schema([
                    IconEntry::make('is_active')
                        ->label('Activo')
                        ->icon(fn($state): Heroicon => match ((string) $state) {
                            '1', 'true' => Heroicon::CheckCircle,
                            default => Heroicon::XCircle,
                        })
                        ->color(fn($state): string => in_array((string) $state, ['1', 'true'], true) ? 'success' : 'danger'),

                    IconEntry::make('is_featured')
                        ->label('Destacado')
                        ->icon(fn($state): Heroicon => match ((string) $state) {
                            '1', 'true' => Heroicon::CheckCircle,
                            default => Heroicon::XCircle,
                        })
                        ->color(fn($state): string => in_array((string) $state, ['1', 'true'], true) ? 'success' : 'danger'),

                    IconEntry::make('has_price')
                        ->label('Mostrar precio')
                        ->icon(fn($state): Heroicon => match ((string) $state) {
                            '1', 'true' => Heroicon::CheckCircle,
                            default => Heroicon::XCircle,
                        })
                        ->color(fn($state): string => in_array((string) $state, ['1', 'true'], true) ? 'success' : 'danger'),
                ])
                ->columns(3)
                ->columnSpanFull(),

            Section::make('Descripción del producto')
                ->schema([
                    TextEntry::make('description')
                        ->label('Descripción')
                        ->html()
                        ->columnSpanFull(),
                ])
                ->columns(1)
                ->columnSpanFull(),
        ]);
    }
}
