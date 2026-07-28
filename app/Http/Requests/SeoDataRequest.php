<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SeoDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'seoable_type' => ['required', 'string'],
            'seoable_id' => [
                'required',
                'integer',
                Rule::unique('seo_data')
                    ->where(
                        fn($query) => $query
                            ->where('seoable_type', $this->seoable_type)
                    )
                    ->ignore($this->route('seo_data')), // 👈 para update
            ],

            // SEO
            'seo_title' => ['nullable', 'array'],
            'seo_description' => ['nullable', 'array'],
            'seo_canonical' => ['nullable', 'array'],
            'seo_noindex' => ['boolean'],
            'seo_nofollow' => ['boolean'],

            // Open Graph
            'og_title' => ['nullable', 'array'],
            'og_description' => ['nullable', 'array'],
            'og_image' => ['nullable', 'string', 'max:255'],

            // Twitter
            'twitter_title' => ['nullable', 'array'],
            'twitter_description' => ['nullable', 'array'],
            'twitter_image' => ['nullable', 'array'],

            // Fechas
            'valid_from' => ['nullable', 'date'],
            'valid_until' => ['nullable', 'date', 'after_or_equal:valid_from'],

            // Otros
            'schema_type' => ['nullable', 'string', 'max:50'],
            'focus_keyword' => ['nullable', 'array'],
        ];
    }

    protected function prepareForValidation(): void
    {
        // Normaliza checkboxes (Blade / Filament / HTML forms)
        $this->merge([
            'seo_noindex' => (bool) $this->seo_noindex,
            'seo_nofollow' => (bool) $this->seo_nofollow,
        ]);
    }

    public function messages(): array
    {
        return [
            'seoable_id.unique' => 'Este modelo ya tiene SEO asignado.',
            'valid_until.after_or_equal' => 'La fecha final debe ser posterior o igual a la inicial.',
        ];
    }
}
