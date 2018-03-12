<?php

namespace TeamPickr\DistanceMatrix;

use Psr\Http\Message\ResponseInterface;

class DistanceMatrixResponse
{
    const RESPONSE_OKAY = 'OK';
    const RESPONSE_INVALID_REQUEST = 'INVALID_REQUEST';
    const RESPONSE_MAX_ELEMENTS_EXCEEDED = 'MAX_ELEMENTS_EXCEEDED';
    const RESPONSE_OVER_QUERY_LIMIT = 'OVER_QUERY_LIMIT';
    const RESPONSE_REQUEST_DENIED = 'REQUEST_DENIED';
    const RESPONSE_UNKNOWN_ERROR = 'UNKNOWN_ERROR';

    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    protected $response;

    /**
     * @var array
     */
    protected $json;

    /**
     * DistanceMatrixResponse constructor.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
        $this->json     = json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @return bool
     */
    public function successful()
    {
        return $this->json['status'] === static::RESPONSE_OKAY;
    }

    /**
     * @return array
     */
    public function origins()
    {
        return $this->json["origin_addresses"];
    }

    /**
     * @return array
     */
    public function destinations()
    {
        return $this->json["destination_addresses"];
    }

    /**
     * @return array
     */
    public function rows()
    {
        return $this->json["rows"];
    }
}