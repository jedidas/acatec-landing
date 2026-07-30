<?php

namespace App\Seo\Schema;

class SchemaFactory
{
    public static function make($model, ?string $schema_type = null, ?string $finalImage = null): array
    {
        $schemaType = isset($model?->seoData?->schema_type) ? $model?->seoData?->schema_type : $schema_type;

        return match ($schemaType) {
            'Article'       => (new ArticleSchema(model: $model, image: $finalImage))->toArray(),
            'Offer'         => (new OfferSchema(model: $model, image: $finalImage))->toArray(),
            'Product'       => (new ProductSchema(model: $model, image: $finalImage))->toArray(),
            'Service'       => (new ServiceSchema(model: $model, image: $finalImage))->toArray(),
            'Event'         => (new EventSchema(model: $model, image: $finalImage))->toArray(),
            'SaleEvent'     => (new SaleEventSchema(model: $model, image: $finalImage))->toArray(),
            'WebPage'       => (new WebPageSchema(model: $model, image: $finalImage))->toArray(),
            'StaticWebPage' => (new StaticWebPageSchema(model: $model, image: $finalImage))->toArray(),
            'CreativeWork'  => (new CreativeWorkSchema(model: $model, image: $finalImage))->toArray(),
            'LocalBusiness' => (new LocalBusinessSchema(model: $model, image: $finalImage))->toArray(),
            default         => (new OfferSchema(model: $model, image: $finalImage))->toArray(),
        };
    }
}
