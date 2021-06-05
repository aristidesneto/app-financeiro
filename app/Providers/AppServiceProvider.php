<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Entry;
use App\Models\CreditCard;
use App\Observers\UserObserver;
use App\Observers\EntryObserver;
use App\Observers\CreditCardObserver;
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
        if (! $this->app->runningInConsole()) {
            Entry::observe(EntryObserver::class);
            CreditCard::observe(CreditCardObserver::class);
            User::observe(UserObserver::class);
        }

        Schema::defaultStringLength(191);
    }
}
