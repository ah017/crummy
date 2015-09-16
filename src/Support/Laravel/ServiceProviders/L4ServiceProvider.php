<?php namespace Wibleh\Crummy\Support\Laravel\ServiceProviders;

use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

class L4ServiceProvider extends LaravelServiceProvider
{
    use ServiceProviderTrait;

    public function boot()
    {
        $this->package('wibleh/crummy');
    }

    public function provides()
    {
        return array('crummy');
    }
}