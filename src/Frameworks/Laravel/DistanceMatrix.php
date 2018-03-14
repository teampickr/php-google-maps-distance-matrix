<?php

namespace TeamPickr\DistanceMatrix\Frameworks\Laravel;

use Illuminate\Support\Facades\Facade;

/**
 * Class DistanceMatrix
 *
 * @package TeamPickr\DistanceMatrix\Frameworks\Laravel
 */
class DistanceMatrix extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return \TeamPickr\DistanceMatrix\DistanceMatrix::class;
    }
}