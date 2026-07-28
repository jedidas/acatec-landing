<?php

namespace App\Filament\Resources\Products\Schemas;

use App\Models\Category;
use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\CodeEditor\Enums\Language;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\ViewField;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProductForm
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
                                    ->directory('uploads/products')
                                    ->image()
                                    ->imageEditor()
                                    ->automaticallyResizeImagesMode('cover')
                                    ->automaticallyCropImagesToAspectRatio('16:12')
                                    ->automaticallyResizeImagesToWidth('1000')
                                    ->automaticallyResizeImagesToHeight('750')
                                    ->imageEditorMode(2)
                                    ->visibility('public')
                                    ->required()
                                    ->maxSize(24000)
                                    ->rules(['mimes:jpg,jpeg,png', 'max:24000']),

                                Select::make('category_id')
                                    ->label("Categoria")
                                    ->options(function () {
                                        $result = [];
                                        $results = Category::where('is_active',  true)
                                            ->get()
                                            ->map(function ($table) {
                                                return [$table->id, $table->name];
                                            })
                                            ->toArray();
                                        foreach ($results as $item) {
                                            $result[$item[0]] = $item[1];
                                        }
                                        return $result;
                                    })
                                    ->searchable()
                                    ->required(),

                                TextInput::make('name')
                                    ->label('Nombre')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Get $get, Set $set, ?string $old, ?string $state) {
                                        $slug = $get('slug');

                                        if (
                                            blank($slug) ||
                                            $slug === Str::slug($old)
                                        ) {
                                            $set('slug', Str::slug($state));
                                        }
                                    }),

                                TextInput::make('slug')
                                    ->label('Slug')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->dehydrateStateUsing(
                                        fn(?string $state, Get $get) => Str::slug($state ?: $get('name'))
                                    )
                                    ->columnSpanFull(),

                                TextInput::make('code')
                                    ->label('Código')
                                    ->nullable()
                                    ->unique(ignoreRecord: true),

                                TextInput::make('price')
                                    ->label("Precio")
                                    ->numeric()
                                    ->minValue(0)
                                    ->default(0)
                                    ->required()
                                    ->prefixIcon('heroicon-m-banknotes')
                                    ->suffix('.00'),

                                TextInput::make('discount')
                                    ->label("Descuento")
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0)
                                    ->maxValue(100)
                                    ->required()
                                    ->prefix('%'),

                                RichEditor::make('description')
                                    ->label("Descripción")
                                    ->required()
                                    ->maxLength(65535)
                                    ->columnSpanFull(),

                                Repeater::make('features')
                                    ->label('Características')
                                    ->schema([
                                        TextInput::make('name')
                                            ->label('Título')
                                            ->required(fn($get) => filled($get('value')))
                                            ->live(onBlur: true),

                                        TextInput::make('value')
                                            ->label('Texto')
                                            ->required(fn($get) => filled($get('name')))
                                            ->live(onBlur: true),
                                    ])
                                    ->addActionLabel('Agregar característica')
                                    ->columnSpanFull(),

                                Toggle::make('is_active')
                                    ->label('Activo')
                                    ->default(true),

                                Toggle::make('is_featured')
                                    ->label('Destacado')
                                    ->default(false),

                                Toggle::make('has_price')
                                    ->label('Mostrar precio')
                                    ->default(false),
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

                                        TextInput::make('schema_type')
                                            ->disabled()
                                            ->label('Tipo de Schema')
                                            ->default('ProductSchemaFinal'),

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
