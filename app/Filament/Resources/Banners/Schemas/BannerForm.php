<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image')
                    ->label('Imagen')
                    ->columnSpan('full')
                    ->disk('public')
                    ->directory('uploads/banners')
                    ->image()
                    ->imageEditor()
                    ->automaticallyResizeImagesMode('cover')
                    ->automaticallyCropImagesToAspectRatio('16:6')
                    ->automaticallyResizeImagesToWidth('4200')
                    ->automaticallyResizeImagesToHeight('1576')
                    ->imageEditorMode(2)
                    ->visibility('public')
                    ->required()
                    ->maxSize(40000)
                    ->rules(['mimes:jpg,jpeg,png', 'max:40000']),
                FileUpload::make('mobile')
                    ->label('Imagen movil')
                    ->columnSpan('full')
                    ->disk('public')
                    ->directory('uploads/banners')
                    ->image()
                    ->imageEditor()
                    ->automaticallyResizeImagesMode('cover')
                    ->automaticallyCropImagesToAspectRatio('1:1')
                    ->automaticallyResizeImagesToWidth('1080')
                    ->automaticallyResizeImagesToHeight('1080')
                    ->imageEditorMode(2)
                    ->visibility('public')
                    ->required()
                    ->maxSize(40000)
                    ->rules(['mimes:jpg,jpeg,png', 'max:40000']),
                TextInput::make('link')
                    ->label('Enlace')
                    ->url(),
                Select::make('target')
                    ->label("Destino")
                    ->required()
                    ->options([
                        '_self' => '_self',
                        '_blank' => '_blank',
                        '_parent' => '_parent',
                        '_top' => '_top',
                    ])
                    ->default('_self'),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true)
            ]);
    }
}
