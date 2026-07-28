<?php

namespace App\Filament\Resources\Promotions\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Icons\Heroicon;

class PromotionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Promoción')
                    ->description('Información de la promoción')
                    ->schema([
                        ImageEntry::make('image')
                            ->disk('public')
                            ->visibility('public')
                            ->label('Imagen')
                            ->imageSize('100%')
                            ->alignCenter()
                            ->columnSpanFull(),

                        TextEntry::make('name')
                            ->label('Nombre')
                            ->icon(Heroicon::Cube)
                            ->iconPosition(IconPosition::Before)
                            ->iconColor('primary'),

                        IconEntry::make('is_active')
                            ->label('Activo')
                            ->icon(fn($state): Heroicon => match ((string) $state) {
                                '1', 'true' => Heroicon::CheckCircle,
                                default => Heroicon::XCircle,
                            })
                            ->color(fn($state): string => in_array((string) $state, ['1', 'true'], true) ? 'success' : 'danger'),

                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                Section::make('Descripción')
                    ->schema([
                        TextEntry::make('content')
                            ->label('Descripción')
                            ->html()
                            ->columnSpanFull(),
                    ])
                    ->columns(1)
                    ->columnSpanFull(),



            ]);
    }
}
