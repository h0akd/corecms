<?php

namespace H0akd\Corecms;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use

class CorecmsServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot() {
        $this->package('h0akd/corecms', 'CoreCms');
        include dirname(dirname(__DIR__)) . '/filters.php';
        include dirname(dirname(__DIR__)) . '/routers.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register() {
        $bootstrapform = new \H0akd\Bootstrapform\BootstrapformServiceProvider($this->app);
        $this->app->register($bootstrapform);
        $bootstrapform->boot();


        $htmlminitify = new \H0akd\Htmlminify\HtmlminifyServiceProvider($this->app);
        $this->app->register($htmlminitify);
        $htmlminitify->boot();

        AliasLoader::getInstance()->alias('Sentry', 'Cartalyst\Sentry\Facades\Laravel\Sentry');

        $this->app['corecms.install'] = $this->app->share(function($app) {
            return new \H0akd\Corecms\Commands\InstallCommand();
        });
        $this->app['corecms.seed'] = $this->app->share(function($app) {
            return new \H0akd\Corecms\Commands\SeedCommand();
        });
        $this->commands(
                'corecms.install', 'corecms.seed'
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides() {
        return array();
    }

}
