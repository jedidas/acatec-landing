<?php

namespace App\Filament\Resources\Promotions\Schemas;

use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\CodeEditor\Enums\Language;
use Illuminate\Support\Str;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;

use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;

class PromotionForm
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
                                    ->directory('uploads/promotions')
                                    ->image()
                                    ->imageEditor()
                                    ->automaticallyCropImagesToAspectRatio('16:4')
                                    ->imageEditorMode(2)
                                    ->visibility('public')
                                    ->required()
                                    ->rules(['mimes:jpg,jpeg,png', 'max:1024']),

                                TextInput::make('name')
                                    ->label('Nombre')
                                    ->columnSpan('full')
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                RichEditor::make('content')
                                    ->label("Contenido")
                                    ->required()
                                    ->maxLength(65535)
                                    ->columnSpanFull()
                                    ->toolbarButtons([
                                        [
                                            'attachFiles',
                                            'blockquote',
                                            'bold',
                                            'bulletList',
                                            'codeBlock',
                                            'grid',
                                            'gridDelete',
                                            'italic',
                                            'link',
                                            'orderedList',
                                            'strike',
                                            'underline',
                                            'textColor',

                                            'superscript',
                                            'subscript'
                                        ],
                                        'table' => [
                                            'tableAddColumnBefore',
                                            'tableAddColumnAfter',
                                            'tableDeleteColumn',
                                            'tableAddRowBefore',
                                            'tableAddRowAfter',
                                            'tableDeleteRow',
                                            'tableMergeCells',
                                            'tableSplitCell',
                                            'tableToggleHeaderRow',
                                            'tableDelete',
                                        ],
                                        ['h2', 'h3', 'alignStart', 'alignCenter', 'alignEnd'],
                                        ['undo', 'redo'],
                                    ])
                                    ->fileAttachmentsDirectory('uploads/promotions'),

                                Toggle::make('is_active')
                                    ->label('Activo')
                                    ->columnSpan('full')
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

                                        TextInput::make('seo_canonical')
                                            ->label('URL Canónica')
                                            ->unique(ignoreRecord: true)
                                            ->helperText('Opcional. Útil para evitar contenido duplicado')
                                            ->afterStateUpdated(function ($state, callable $set) {
                                                $set('seo_canonical', Str::slug($state));
                                            }),

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

                                        Select::make('schema_type')
                                            ->label('Tipo de Schema')
                                            ->options([
                                                'Article'       => 'Artículo / Contenido',
                                                'Offer'         => 'Oferta / Promoción',
                                                'Product'       => 'Producto',
                                                'Service'       => 'Servicio',
                                                'Event'         => 'Evento',
                                                'SaleEvent'     => 'Evento de Venta',
                                                'WebPage'       => 'Página Comercial',
                                                'CreativeWork'  => 'Publicidad / Campaña',
                                                'LocalBusiness' => 'Negocio Local',
                                            ])
                                            ->default('Offer')
                                            ->required()
                                            ->helperText('Elegí el tipo que mejor represente el contenido para Google'),

                                        TextInput::make('price')
                                            ->label("Precio")
                                            ->numeric()
                                            ->minValue(0)
                                            ->default(null)
                                            ->prefixIcon('heroicon-m-banknotes')
                                            ->suffix('.00'),

                                        TextInput::make('discount')
                                            ->label("Descuento")
                                            ->numeric()
                                            ->default(null)
                                            ->minValue(0)
                                            ->maxValue(100)
                                            ->prefix('%'),

                                        TagsInput::make('focus_keyword')
                                            ->label('Palabra clave principal')
                                            ->separator(',')
                                            ->helperText('La palabra clave principal por la que quieres rankear esta página.'),

                                        DateTimePicker::make('valid_from')
                                            ->label("Fecha de inicio")
                                            ->default(null),

                                        DateTimePicker::make('valid_until')
                                            ->label("Fecha de finalización")
                                            ->default(null),

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
