<?php

namespace TeamPickr\DistanceMatrix\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use TeamPickr\DistanceMatrix\DistanceMatrix;
use TeamPickr\DistanceMatrix\Response\DistanceMatrixResponse;
use TeamPickr\DistanceMatrix\Stack\LicenseMiddleware;

/**
 * Class DistanceMatrixRequest
 *
 * @package TeamPickr\DistanceMatrix
 */
class DistanceMatrixRequest
{
    const BASE_URI = "https://maps.googleapis.com/maps/api/distancematrix/";

    /**
     * @var DistanceMatrix
     */
    protected $settings;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var HandlerStack
     */
    protected $stack;

    /**
     * DistanceMatrixRequest constructor.
     *
     * @param DistanceMatrix          $settings
     * @param MockHandler|CurlHandler $handler
     */
    public function __construct(DistanceMatrix $settings, $handler = null)
    {
        $this->settings = $settings;
        $this->stack    = HandlerStack::create($handler ?? new CurlHandler());
        $this->client   = new Client([
            'base_uri' => static::BASE_URI,
            'handler'  => $this->stack,
        ]);

        $this->pushMiddleware(new LicenseMiddleware($this->settings->getLicense()));
    }

    /**
     * @param callable $middleware
     *
     * @return $this
     */
    public function pushMiddleware(callable $middleware)
    {
        $this->stack->push($middleware);

        return $this;
    }

    /**
     * @return array
     */
    protected function buildQuery()
    {
        $options = array_merge([
            'origins'                    => $this->buildOrigins(),
            'destinations'               => $this->buildDestinations(),
            'mode'                       => $this->settings->getMode(),
            'units'                      => $this->settings->getUnits(),
            'avoid'                      => $this->settings->getAvoid(),
            'region'                     => $this->settings->getRegion(),
            'language'                   => $this->settings->getLanguage(),
            'arrival_time'               => $this->settings->getArrivalTime(),
            'departure_time'             => $this->settings->getDepartureTime(),
            'traffic_model'              => $this->settings->getTrafficModel(),
            'transit_mode'               => $this->buildTransitMode(),
            'transit_routing_preference' => $this->settings->getTransitRoutingPreference(),
        ]);

        return array_filter($options, function ($value) {
            return $value !== null || $value === "";
        });
    }

    /**
     * @return string
     */
    protected function buildOrigins()
    {
        return implode("|", $this->settings->getOrigins());
    }

    /**
     * @return string
     */
    protected function buildDestinations()
    {
        return implode("|", $this->settings->getDestinations());
    }

    /**
     * @return string
     */
    protected function buildTransitMode()
    {
        return implode("|", $this->settings->getTransitMode());
    }

    /**
     * @return DistanceMatrixResponse
     */
    public function request()
    {
        return new DistanceMatrixResponse(
            $this->client->get('json', [
                'query' => $this->buildQuery(),
            ])
        );
    }
}