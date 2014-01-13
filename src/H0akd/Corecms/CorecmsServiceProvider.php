<?php

namespace H0akd\Corecms;

use Illuminate\Support\ServiceProvider;
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
