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
    public function successful(): bool
    {
        return $this->element['status'] == static::STATUS_OKAY;
    }

    /**
     * @return null|int
     */
    public function distance()
    {
        return ! empty($this->element['distance']['value']) ? $this->element['distance']['value'] : null;
    }

    /**
     * @return null|string
     */
    public function distanceText()
    {
        return ! empty($this->element['distance']['text']) ? $this->element['distance']['text'] : null;
    }

    /**
     * @return null|int
     */
    public function duration()
    {
        return ! empty($this->element['duration']['value']) ? (int) $this->element['duration']['value'] : null;
    }

    /**
     * @return null|string
     */
    public function durationText()
    {
        return ! empty($this->element['duration']['text']) ? (string) $this->element['duration']['text'] : null;
    }

    /**
     * @return null|int
     */
    public function durationInTraffic()
    {
        return ! empty($this->element['duration_in_traffic']['value']) ? (int) $this->element['duration_in_traffic']['value'] : null;
    }
    /**
     * @return null|string
     */
    public function durationInTrafficText()
    {
        return ! empty($this->element['duration_in_traffic']['text']) ? (string) $this->element['duration_in_traffic']['text'] : null;
    }
}
