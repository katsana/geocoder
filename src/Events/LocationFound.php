<?php

namespace Katsana\Geocoder\Events;

use Katsana\Geocoder\Location;

class LocationFound
{
    /**
     * Location instance.
     *
     * @var \Katsana\Geocoder\Location
     */
    public $location;

    /**
     * Found location.
     */
    public function __construct(Location $location)
    {
        $this->location = $location;
    }
}
