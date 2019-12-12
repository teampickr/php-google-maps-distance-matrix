<?php

namespace TeamPickr\DistanceMatrix\Response;

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
    public $json;

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
    public function successful(): bool
    {
        return $this->json['status'] === static::RESPONSE_OKAY;
    }

    /**
     * @return null|string
     */
    public function error()
    {
        switch ($this->json['status']) {

            case static::RESPONSE_INVALID_REQUEST:
                return "Request provided was invalid.";

            case static::RESPONSE_MAX_ELEMENTS_EXCEEDED:
                return "Too many origins or destinations provided.";

            case static::RESPONSE_OVER_QUERY_LIMIT:
                return "You have exceeded the amount of API requests allowed in this time period.";

            case static::RESPONSE_REQUEST_DENIED:
                return "Your request was denied. Incorrect authentication?";

            case static::RESPONSE_UNKNOWN_ERROR:
                return "Unknown error occurred.";

            default:
                return null;
        }

    }

    /**
     * @return array
     */
    public function origins(): array
    {
        return $this->json["origin_addresses"];
    }

    /**
     * @return array
     */
    public function destinations(): array
    {
        return $this->json["destination_addresses"];
    }

    /**
     * @return array
     */
    public function rows(): array
    {
        $rows = $this->json['rows'];

        if (!count($rows)) {
            return [];
        }

        return array_map(function ($row) {
            return new Row($row);
        }, $rows);
    }

    /**
     * @param int $row
     *
     * @return null|\TeamPickr\DistanceMatrix\Response\Row
     */
    public function row(int $row = 0)
    {
        $rows = $this->rows();

        if (array_key_exists($row, $rows)) {
            return $rows[$row];
        }

        return null;
    }
}