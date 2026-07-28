<?php

namespace App\Seo\Schema;

use Carbon\Carbon;
use Illuminate\Support\Facades\App;

class EventSchema
{
    public function __construct(
        private $model,
        private string $image,
    ) {}

    public function toArray(): array
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Event',
            'name' => $this->model->seoTitle(),
            'description' => $this->model->seoDescription(),
            'keywords' => $this->model->focusKeyword(),
            'url' => route('promotion.index', ['slug' => $this->model->canonicalUrl()]),
            'image' => asset($this->image),
            'startDate' => Carbon::parse($this->model->valid_from)->toIso8601String(),
            'endDate' => Carbon::parse($this->model->valid_until)->toIso8601String(),
            'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
            'eventStatus' => 'https://schema.org/EventScheduled',
            'url' => route('promotion.index', ['slug' => $this->model->canonicalUrl()]),
        ];
    }
}
