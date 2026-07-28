<?php

namespace App\Filament\Resources\Quotations\Schemas;

use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class QuotationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Toggle::make('is_active')
                    ->label('Verificado')
                    ->default(true),
            ]);
    }
}
