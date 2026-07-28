<?php

namespace App\Seo;

class SeoData
{
    public function __construct(
        public string $title,
        public string $description,
        public string $canonical,
        public string $robots,
        public array  $og,
        public array  $twitter,
        public array  $schema,
    ) {}
}
