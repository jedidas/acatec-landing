<?php

namespace App\Filament\Resources\Pages\Schemas;

use App\Models\Page;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class PageForm
{

    public static function canCreate(): bool
    {
        return false;
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('slug')
                    ->label('Página')
                    ->options(Page::STATIC_PAGES)
                    ->disabled() // No se puede cambiar
                    ->columnSpanFull()
                    ->required(),

                FileUpload::make('image')
                    ->label('Imagen')
                    ->columnSpan('full')
                    ->disk('public')
                    ->directory('uploads/pages')
                    ->image()
                    ->imageEditor()
                    ->automaticallyResizeImagesMode('cover')
                    ->automaticallyCropImagesToAspectRatio('180:30')
                    ->automaticallyResizeImagesToWidth('1154')
                    ->automaticallyResizeImagesToHeight('356')
                    ->imageEditorMode(2)
                    ->visibility('public')
                    ->maxSize(24000)
                    ->rules(['mimes:jpg,jpeg,png', 'max:24000']),

                Section::make('SEO')
                    ->relationship('seoData')
                    ->schema([

                        Hidden::make('schema_type')
                            ->default('StaticWebPage'),

                        FileUpload::make('og_image')
                            ->label('Imagen Open Graph')
                            ->disk('public')
                            ->directory('uploads/seo')
                            ->image()
                            ->imageEditor()
                            ->automaticallyResizeImagesMode('cover')
                            ->automaticallyCropImagesToAspectRatio('1.91:1')
                            ->automaticallyResizeImagesToWidth(1200)
                            ->automaticallyResizeImagesToHeight(630)
                            ->imageEditorMode(2)
                            ->helperText('Recomendado: 1200x630 px (Open Graph)')
                            ->columnSpanFull(),

                        TextInput::make('seo_title')
                            ->label('Título SEO')
                            ->maxLength(60)
                            ->helperText('Título que se muestra en Google (máx. 60 caracteres)')
                            ->columnSpanFull(),

                        Textarea::make('seo_description')
                            ->label('Meta Description')
                            ->maxLength(160)
                            ->helperText('Descripción para Google (máx. 160 caracteres)')
                            ->columnSpanFull(),

                        Toggle::make('seo_noindex')
                            ->label('No indexar en Google')
                            ->helperText('Dejar vacío si desea generar automáticamente'),

                        Toggle::make('seo_nofollow')
                            ->label('No seguir enlaces'),
                        TagsInput::make('focus_keyword')
                            ->label('Palabra clave principal')
                            ->separator(',')
                            ->helperText('La palabra clave principal por la que quieres rankear esta página.'),

                        ViewField::make('seo_preview')
                            ->label('Vista previa en Google')
                            ->view('seo.preview')
                            ->dehydrated(false)
                            ->afterStateHydrated(function (ViewField $component, $state, $record) {
                                $component->state([
                                    'title' => $record?->seo_title ?? 'Título de ejemplo',
                                    'description' => $record?->seo_description ?? 'Descripción de ejemplo',
                                    'url' => $record?->slug
                                        ? route('promotion.index', ['slug' => $record->slug])
                                        : url('promociones/promocion-ejemplo'),
                                ]);
                            })
                            ->columnSpanFull(),

                    ])
                    ->columnSpanFull(),
            ]);
    }
}
