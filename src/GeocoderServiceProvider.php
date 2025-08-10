<?php

namespace Katsana\Geocoder;

use Geocoder\Geocoder;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class GeocoderServiceProvider extends ServiceProvider implements DeferrableProvider
{

    /**
     * Class aliases.
     *
     * @var array
     */
    protected $aliases = [
        'katsana.geocoder' => Manager::class,
    ];

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->registerGeocoder();
    }

    /**
     * Register geocoder service provider.
     */
    protected function registerGeocoder(): void
    {
        $this->app->singleton('katsana.geocoder', static function ($app) {
            return new Manager($app);
        });

        // Allow resolving by class name as well
        $this->app->singleton(Manager::class, function ($app) {
            return $app->make('katsana.geocoder');
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'katsana.geocoder',
            Manager::class,
        ];
    }
}
