<?php

namespace App\Filament\Resources\Emails;

use App\Filament\Resources\Emails\Pages\ListEmails;
use App\Filament\Resources\Emails\Pages\ViewEmail;
use App\Filament\Resources\Emails\Schemas\EmailForm;
use App\Filament\Resources\Emails\Tables\EmailsTable;
use Filament\Infolists;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

use App\Models\Email;

use BackedEnum;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Support\Enums\IconPosition;

class EmailResource extends Resource
{
    protected static ?string $model = Email::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Envelope;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return EmailForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EmailsTable::configure($table);
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
            'index' => ListEmails::route('/'),
            'view' => ViewEmail::route('/{record}'),
        ];
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Detalles del contacto')
                ->schema([
                    Grid::make(2)->schema([
                        Infolists\Components\TextEntry::make('name')
                            ->label('Nombre')
                            ->icon(Heroicon::User)
                            ->iconPosition(IconPosition::Before)
                            ->iconColor('primary'),

                        Infolists\Components\TextEntry::make('subject')
                            ->label('Asunto')
                            ->icon(Heroicon::Tag)
                            ->iconPosition(IconPosition::Before)
                            ->iconColor('info'),

                        Infolists\Components\TextEntry::make('email')
                            ->label('Email')
                            ->icon(Heroicon::Envelope)
                            ->iconPosition(IconPosition::Before)
                            ->iconColor('primary')
                            ->copyable(true),

                        Infolists\Components\TextEntry::make('phone')
                            ->label('Teléfono')
                            ->icon(Heroicon::Phone)
                            ->iconPosition(IconPosition::Before)
                            ->iconColor('primary')
                            ->copyable(true),
                    ]),

                    Infolists\Components\TextEntry::make('added_on')
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
                    Infolists\Components\TextEntry::make('message')
                        ->label('Contenido del mensaje')
                        ->html()
                        ->columnSpanFull(),
                ])
                ->collapsible()
                ->columnSpanFull(),
        ]);
    }
}
