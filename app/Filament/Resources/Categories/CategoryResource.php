<?php

namespace App\Filament\Resources\Categories;

use App\Filament\Resources\Categories\Pages\CreateCategory;
use App\Filament\Resources\Categories\Pages\EditCategory;
use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Filament\Resources\Categories\Pages\ViewCategory;
use App\Filament\Resources\Categories\Schemas\CategoryForm;
use App\Filament\Resources\Categories\Tables\CategoriesTable;
use App\Models\Category;
use BackedEnum;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;


class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::ListBullet;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $label = "Categoría";
    protected static ?string $pluralLabel = "categorías";

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'view' => ViewCategory::route('/{record}'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Producto')
                ->schema([
                    ImageEntry::make('image')
                        ->disk('public')
                        ->visibility('public')
                        ->label('Imagen')
                        ->imageSize('100%')
                        ->columnSpanFull(),

                    TextEntry::make('name')
                        ->label('Nombre')
                        ->icon(Heroicon::Cube)
                        ->iconPosition(IconPosition::Before)
                        ->iconColor('primary'),

                    TextEntry::make('menu')
                        ->label('Menu')
                        ->icon(Heroicon::Cube)
                        ->iconPosition(IconPosition::Before)
                        ->iconColor('primary'),

                    IconEntry::make('is_active')
                        ->label('Activo')
                        ->icon(fn(string $state): Heroicon => match ($state) {
                            '1' => Heroicon::CheckCircle,
                            '0' => Heroicon::XCircle,
                            default => Heroicon::XCircle,
                        })
                        ->color(fn(string $state): string => $state === '1' ? 'success' : 'danger'),
                ])
                ->columns(1)
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
