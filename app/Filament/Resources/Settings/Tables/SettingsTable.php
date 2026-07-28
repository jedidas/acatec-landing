<?php

namespace App\Filament\Resources\Settings\Tables;

use App\Models\Setting;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->label('Columna')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('value')
                    ->label('Valor')
                    ->formatStateUsing(fn($state) => $state === null ? 'Empty' : $state)
                    ->sortable()
                    ->searchable(),
                TextColumn::make('order')
                    ->label('Orden')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // EditAction::make(),
                EditAction::make()
                    ->schema(function (Setting $record) {
                        return match ($record->type) {
                            'select' => [
                                Select::make('value')
                                    ->label($record->label)
                                    ->options($record->attributes['options'])
                            ],
                            'color' => [
                                ColorPicker::make('value')
                                    ->label($record->label)
                            ],
                            'number' => [
                                TextInput::make('value')
                                    ->label($record->label)
                                    ->type('number')
                            ],
                            'phones' => [
                                Repeater::make('attributes')
                                    ->label($record->label)
                                    ->schema([
                                        TextInput::make('number')
                                            ->label('Número de teléfono')
                                            ->required(),
                                        TextInput::make('visible_number')
                                            ->label('Número de teléfono visible')
                                            ->required(),
                                        Toggle::make('is_whatsapp')
                                            ->label('Es whatsapp')
                                            ->default(false),
                                    ])
                                    ->addActionLabel('Agregar el número de teléfono')
                                    ->collapsible(),
                            ],
                            'values' => [
                                Repeater::make('attributes')
                                    ->label($record->label)
                                    ->schema([
                                        TextInput::make('value')
                                            ->label('Valor')
                                            ->required(),
                                    ])
                                    ->addActionLabel('Agregar el número de teléfono')
                                    ->reorderable()
                                    ->collapsible(),
                            ],
                            'key_value' => [
                                Repeater::make('attributes')
                                    ->label($record->label)
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Nombre')
                                            ->required(),
                                        TextInput::make('value')
                                            ->label('Valor')
                                            ->required(),
                                    ])
                                    ->addActionLabel('Agregar el número de teléfono')
                                    ->collapsible(),
                            ],
                            'social_networks' => [
                                Repeater::make('values')
                                    ->label($record->label)
                                    ->schema([
                                        Select::make('networks')
                                            ->label($record->label)
                                            ->options($record->attributes['options'])
                                            ->required(),
                                        TextInput::make('name')
                                            ->label('Nombre')
                                            ->required(),
                                        TextInput::make('url')
                                            ->url()
                                            ->label('Enlace')
                                            ->required(),
                                    ])
                                    ->addActionLabel('Agregar red social')
                                    ->collapsible(),
                            ],
                            default => [
                                TextInput::make('value')
                                    ->label($record->label)
                            ]
                        };
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
