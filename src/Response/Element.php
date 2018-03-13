<?php

namespace TeamPickr\DistanceMatrix\Response;

class Element
{
    const STATUS_OKAY = 'OK';
    const STATUS_NOT_FOUND = 'NOT_FOUND';
    const STATUS_ZERO_RESULTS = 'ZERO_RESULTS';
    const STATUS_MAX_ROUTE_LENGTH_EXCEEDED = 'MAX_ROUTE_LENGTH_EXCEEDED';

    /**
     * @var array
     */
    protected $element;

    /**
     * Element constructor.
     *
     * @param $element
     */
    public function __construct(array $element)
    {
        $this->element = $element;
    }

    /**
     * @return bool
     */
    public function successful()
    {
        return $this->element['status'] == static::STATUS_OKAY;
    }

    /**
     * @return mixed
     */
    public function distance()
    {
        return $this->element['distance']['value'];
    }

    /**
     * @return mixed
     */
    public function distanceText()
    {
        return $this->element['distance']['text'];
    }

    /**
     * @return mixed
     */
    public function duration()
    {
        return $this->element['duration']['value'];
    }

    /**
     * @return mixed
     */
    public function durationText()
    {
        return $this->element['distance']['text'];
    }
}