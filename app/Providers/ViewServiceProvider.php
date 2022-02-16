<?php

namespace App\Providers;

use App\Http\Composers\BreadcrumbComposer;
use App\Http\Composers\PublishComposer;
use App\Http\Composers\SessionDbComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Http\Composers\LanguagesComposer;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        View::composer('*', BreadcrumbComposer::class);
        View::composer('*', LanguagesComposer::class);
        View::composer('*', PublishComposer::class);
        View::composer('*', SessionDbComposer::class);
    }
}
