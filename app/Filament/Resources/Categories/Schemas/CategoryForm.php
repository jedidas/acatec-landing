<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\CodeEditor\Enums\Language;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([


                Tabs::make('Tabs')
                    ->columnSpanFull()
                    ->tabs([
                        Tab::make('General')
                            ->columnSpanFull()
                            ->schema([
                                FileUpload::make('image')
                                    ->label('Imagen')
                                    ->columnSpan('full')
                                    ->disk('public')
                                    ->directory('uploads/categories')
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

                                TextInput::make('name')
                                    ->label('Nombre')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                        // Solo autocompletar menu si está vacío
                                        if (blank($get('menu'))) {
                                            $set('menu', $state);
                                        }

                                        // Solo autocompletar slug si está vacío
                                        if (blank($get('slug'))) {
                                            $set('slug', Str::slug($state));
                                        }
                                    }),

                                TextInput::make('menu')
                                    ->label('Menu')
                                    ->required()
                                    ->dehydrateStateUsing(
                                        fn(?string $state, Get $get) => filled($state)
                                            ? $state
                                            : $get('name')
                                    ),

                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->dehydrateStateUsing(
                                        fn(?string $state, Get $get) => Str::slug(
                                            filled($state)
                                                ? $state
                                                : $get('name')
                                        )
                                    )
                                    ->columnSpanFull(),

                                RichEditor::make('description')
                                    ->label("Descripción")
                                    ->maxLength(65535)
                                    ->columnSpanFull(),
                                Toggle::make('is_active')
                                    ->label('Activo')
                                    ->default(true),
                            ]),

                        Tab::make('SEO')
                            ->columnSpanFull()
                            ->schema([
                                Section::make('SEO')
                                    ->relationship('seoData')
                                    ->schema([

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
                                            ->helperText('Recomendado: 1200×630 px (Open Graph)')
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

                                        Hidden::make('schema_type')
                                            ->default('Category'),

                                        CodeEditor::make('seo_json')
                                            ->label('JSON Schema')
                                            ->language(Language::JavaScript)
                                            ->default(null)
                                            ->wrap(),

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
                            ]),
                    ]),



            ]);
    }
}
