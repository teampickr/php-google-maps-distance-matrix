<?php

namespace TeamPickr\DistanceMatrix\Frameworks\Laravel;

use Illuminate\Support\Facades\Facade;

class DistanceMatrix extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'DistanceMatrix';
    }
}