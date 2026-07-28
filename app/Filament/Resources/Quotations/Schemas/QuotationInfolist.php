<?php

namespace App\Filament\Resources\Quotations\Schemas;

use Filament\Actions\Action;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Schemas\Schema;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;

class QuotationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Detalles del contacto')
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('name')
                                ->label('Nombre')
                                ->icon(Heroicon::User)
                                ->iconPosition(IconPosition::Before)
                                ->iconColor('primary'),

                            TextEntry::make('email')
                                ->label('Email')
                                ->icon(Heroicon::Envelope)
                                ->iconPosition(IconPosition::Before)
                                ->iconColor('primary')
                                ->copyable(true),

                            TextEntry::make('phone')
                                ->label('Teléfono')
                                ->icon(Heroicon::Phone)
                                ->iconPosition(IconPosition::Before)
                                ->iconColor('primary')
                                ->copyable(true),
                        ]),

                        TextEntry::make('added_on')
                            ->label('Agregado')
                            ->isoDateTime()
                            ->icon(Heroicon::Calendar)
                            ->iconPosition(IconPosition::Before)
                            ->iconColor('warning'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Mensaje')
                    ->schema([
                        TextEntry::make('message')
                            ->label('Contenido del mensaje')
                            ->html()
                            ->columnSpanFull(),
                    ])
                    ->collapsible()
                    ->columnSpanFull(),

                Section::make('Productos cotizados')
                    ->schema([
                        RepeatableEntry::make('products')
                            ->state(fn($record) => is_array($record->products)
                                ? $record->products
                                : json_decode($record->products, true))
                            ->schema([
                                Grid::make(4)->schema([

                                    ImageEntry::make('image')
                                        ->label('Imagen')
                                        ->disk('public')
                                        ->imageHeight(60),

                                    TextEntry::make('name')
                                        ->label('Producto'),

                                    TextEntry::make('quantity')
                                        ->label('Cantidad'),

                                    TextEntry::make('url')
                                        ->label('Enlace')
                                        ->url(fn($state) => $state)
                                        ->openUrlInNewTab()

                                ]),
                            ])
                    ])
                    ->collapsible()
                    ->columnSpanFull(),
            ]);
    }
}
