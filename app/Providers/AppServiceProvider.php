<?php

namespace App\Providers;

use App\Observers\MasterProductObserver;
use App\Observers\ProductObserver;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Schema;
use Vanilo\Foundation\Models\MasterProduct;
use Vanilo\Foundation\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if ($this->app->environment('production') || $this->app->environment('development')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
            $url = $this->app['url'];
            // Force the application URL
            $url->forceRootUrl(config('app.url'));
        }

        $this->app->concord->registerModel(\Konekt\User\Contracts\User::class, \App\User::class);
        
        // Register Product Observers
        Product::observe(ProductObserver::class);
        MasterProduct::observe(MasterProductObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
