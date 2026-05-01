<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        \App\Models\Registration::observe(\App\Observers\RegistrationObserver::class);
        \App\Models\Registration::observe(\App\Observers\AuditLogObserver::class);
        \App\Models\Student::observe(\App\Observers\AuditLogObserver::class);
        \App\Models\Post::observe(\App\Observers\AuditLogObserver::class);

        try {
            $settings = \App\Models\Setting::all();
            $sekolahConfig = config('app.sekolah', []);

            foreach ($settings as $setting) {
                if (array_key_exists($setting->key, $sekolahConfig)) {
                    $sekolahConfig[$setting->key] = $setting->value;
                }
            }

            config(['app.sekolah' => $sekolahConfig]);
        } catch (\Exception $e) {
            // Tabel settings belum ada, gunakan config default
        }
    }
}
