<?php

namespace App\Providers;

use App\Models\Entry;
use App\Observers\EntryObserver;
use Illuminate\Support\Facades\Schema;
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
        Entry::observe(EntryObserver::class);

        Schema::defaultStringLength(191);
    }
}
