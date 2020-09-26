<?php

namespace App\Providers;

use App\Models\Settings;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
/*        $basic_settings = Settings::all();
        unset($settings);
        $settings = array();
        foreach ($basic_settings as $bSet) {
            $settings[$bSet['settings_key']] = $bSet['settings_value'];
        }
        View::share('settings', $settings);*/
    }
}
