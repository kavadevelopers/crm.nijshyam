<?php

namespace App\Providers;

use App\Models\GlobalSettings;
use App\Models\SettingModel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->singleton('App\Models\GlobalSettings', function ($app) {
        //     return new GlobalSettings(SettingModel::all());
        // });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(GlobalSettings $settinsInstance)
    {
        // View::share('globalsettings', $settinsInstance);
    }
}
