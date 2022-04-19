<?php

namespace Katsana\Geocoder;

use Geocoder\Provider\GoogleMaps\GoogleMaps;
use Geocoder\Provider\Nominatim\Nominatim;
use Geocoder\ProviderAggregator;
use Http\Adapter\Guzzle7\Client as Guzzle7HttpAdapter;

class Manager extends \Illuminate\Support\Manager
{
    /**
     * The project identity.
     *
     * @var string
     */
    public static $projectId = 'KATSANA';

    /**
     * Create Google driver.
     *
     * @return \Geocoder\Geocoder
     */
    protected function createGoogleDriver()
    {
        return \tap($this->createProvider(), function ($provider) {
            $provider->registerProvider($this->addGoogleMapProvider());
        });
    }

    /**
     * Create Nominatim Driver.
     *
     * @return \Geocoder\Geocoder
     */
    protected function createNominatimDriver()
    {
        return \tap($this->createProvider(), function ($provider) {
            $provider->registerProvider($this->addNominatimProvider());
        });
    }

    /**
     * Create HTTP Client.
     *
     * @return \Http\Adapter\Guzzle6\Client
     */
    protected function createHttpClient()
    {
        return new Guzzle7HttpAdapter();
    }

    /**
     * Create provider aggregator.
     *
     * @return \Geocoder\Geocoder
     */
    protected function createProvider()
    {
        return new ProviderAggregator();
    }

    /**
     * Add Google map provider.
     *
     * @return \Geocoder\Provider\GoogleMaps
     */
    public function addGoogleMapProvider()
    {
        return new GoogleMaps(
            $this->createHttpClient(), null, \config('services.google.map.key')
        );
    }

    /**
     * Add nominatim provider.
     *
     * @return \Geocoder\Provider\Nominatim
     */
    public function addNominatimProvider()
    {
        return new Nominatim(
            $this->createHttpClient(),
            \config('services.nominatim.url'),
            static::$projectId
        );
    }

    /**
     * Get the default driver name.
     *
     * @return string
     */
    public function getDefaultDriver()
    {
        return 'nominatim';
    }
}
