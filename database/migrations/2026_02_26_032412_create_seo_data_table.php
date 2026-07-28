<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seo_data', function (Blueprint $table) {
            $table->id();

            // Relación polimórfica
            $table->morphs('seoable'); // seoable_id + seoable_type
            $table->unique(['seoable_id', 'seoable_type']); // 👈 evita duplicados

            // SEO
            $table->string('seo_title')->nullable();
            $table->text('seo_json')->nullable();
            $table->text('seo_description')->nullable();
            $table->string('seo_canonical')->nullable();
            $table->boolean('seo_noindex')->default(false);
            $table->boolean('seo_nofollow')->default(false);

            // Open Graph
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('og_image')->nullable();
            $table->string('og_alt_image')->nullable();

            // Twitter
            $table->string('twitter_title')->nullable();
            $table->text('twitter_description')->nullable();
            $table->string('twitter_image')->nullable();

            // Fechas
            $table->timestamp('valid_from')->nullable();
            $table->timestamp('valid_until')->nullable();

            // Schema
            $table->string('schema_type')->default('Offer');
            $table->string('focus_keyword')->nullable();

            $table->string('price')->nullable();
            $table->string('discount')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_data');
    }
};
