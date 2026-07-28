<?php

namespace App\Providers;

use Throwable;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void {}

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {
            if (! Schema::hasTable('settings')) {
                return;
            }

            $settings = Cache::rememberForever('settings', function () {
                return Setting::query()->get();
            });

            foreach ($settings as $setting) {
                switch ($setting->type) {
                    case 'social_networks':
                        config()->set('settings.' . $setting->key, json_encode($setting->values));
                        break;

                    case 'values':
                    case 'phones':
                        config()->set('settings.' . $setting->key, json_encode($setting->attributes));
                        break;

                    default:
                        config()->set('settings.' . $setting->key, $setting->value);
                        break;
                }
            }
        } catch (Throwable $e) {
            report($e);
        }
    }
}
