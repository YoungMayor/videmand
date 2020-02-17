<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;

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
        View::share("___pImgs", Storage::disk("pub_imgs"));
        View::share("___pCSS", Storage::disk("pub_css"));
        View::share("___pFont", Storage::disk("pub_font"));
        View::share("___pJS", Storage::disk("pub_js"));

        Schema::defaultStringLength(191);

    }
}
