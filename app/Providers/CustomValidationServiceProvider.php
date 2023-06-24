<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Rules\Decimal;

class CustomValidationServiceProvider extends ServiceProvider
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
    public function boot()
    {
        $this->app['validator']->extend('decimal', function ($attribute, $value, $parameters, $validator) {
            $rule = new Decimal;
            return $rule->passes($attribute, $value);
        });

        $this->app['validator']->replacer('decimal', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, $message);
        });
    }
}
