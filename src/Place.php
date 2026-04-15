<?php

namespace Katsana\Geocoder;

use Illuminate\Support\Fluent;

class Place extends Fluent
{
    /**
     * All of the attributes set on the container.
     *
     * @var array
     */
    protected $attributes = [
        'areas' => [],
        'locations' => [],
        'address' => null,
        'route' => [],
    ];
}
