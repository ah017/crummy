<?php namespace Wibleh\Crummy\Support\Laravel\ServiceProviders;

use Wibleh\Crummy\Crummy;

trait ServiceProviderTrait
{
    public function register()
    {
        $this->app->singleton('crummy', function () {
            return new Crummy();
        });
    }
}
