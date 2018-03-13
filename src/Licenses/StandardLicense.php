<?php

namespace TeamPickr\DistanceMatrix\Licenses;

use GuzzleHttp\Psr7\Request;
use TeamPickr\DistanceMatrix\Contracts\LicenseContract;

/**
 * Class StandardLicense
 *
 * @package TeamPickr\DistanceMatrix\Licenses
 */
class StandardLicense implements LicenseContract
{
    /**
     * License key
     *
     * @var string
     */
    private $key;

    /**
     * StandardLicense constructor.
     *
     * @param string $key
     */
    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @param \GuzzleHttp\Psr7\Request $request
     *
     * @return array
     */
    public function getQueryStringParameters(Request $request): array
    {
        return [
            'key' => $this->key,
        ];
    }
}