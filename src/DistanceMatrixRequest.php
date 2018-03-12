<?php

namespace TeamPickr\DistanceMatrix;

use GuzzleHttp\Client;

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
     * DistanceMatrixRequest constructor.
     *
     * @param DistanceMatrix $settings
     */
    public function __construct(DistanceMatrix $settings)
    {
        $this->settings = $settings;
        $this->client   = new Client([
            'base_uri' => static::BASE_URI,
        ]);
    }

    /**
     * @return array
     */
    protected function buildQuery()
    {
        return array_merge([
            'origins'      => $this->buildOrigins(),
            'destinations' => $this->buildDestinations(),
            'mode'         => $this->settings->getMode(),
        ]);
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