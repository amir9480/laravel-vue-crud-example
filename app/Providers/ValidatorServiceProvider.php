<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use ReCaptcha\ReCaptcha;
use ReCaptcha\RequestMethod\CurlPost;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extendImplicit('recaptcha',function ($attribute, $value, $parameters, $validator) {
            if(!config('app.google_recaptcha_enabled'))
                return true;
            if( empty($value) )
                return false;
            $recaptcha = new ReCaptcha(config('app.google_recaptcha_secret_key'), new CurlPost());
            $response = $recaptcha->verify($value, request()->ip());
            if ($response->isSuccess()) 
                return true;
            return false;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
