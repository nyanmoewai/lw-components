<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Doctrine\Inflector\Inflector;
use Doctrine\Inflector\InflectorFactory;
use Doctrine\Inflector\Rules\Ruleset;
use Doctrine\Inflector\Rules\Transformations;
use Doctrine\Inflector\Rules\Transformation;

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
       //
    }
}
