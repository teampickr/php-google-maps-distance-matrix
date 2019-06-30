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
        return ! empty($this->element['distance']['value']) ? $this->element['distance']['value'] : null;
    }

    /**
     * @return mixed
     */
    public function distanceText()
    {
        return ! empty($this->element['distance']['text']) ? $this->element['distance']['text'] : null;
    }

    /**
     * @return mixed
     */
    public function duration()
    {
        return ! empty($this->element['duration']['value']) ? $this->element['duration']['value'] : null;
    }

    /**
     * @return mixed
     */
    public function durationText()
    {
        return ! empty($this->element['duration']['text']) ? $this->element['duration']['text'] : null;
    }

    /**
     * @return mixed
     */
    public function durationInTraffic()
    {
        return ! empty($this->element['duration_in_traffic']['value']) ? $this->element['duration_in_traffic']['value'] : null;
    }

    /**
     * @return mixed
     */
    public function durationInTrafficText()
    {
        return ! empty($this->element['duration_in_traffic']['text']) ? $this->element['duration_in_traffic']['text'] : null;
    }
}
