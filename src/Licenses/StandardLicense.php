<?php

namespace TeamPickr\DistanceMatrix\Licenses;

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
    protected $key;

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
     * @param $url
     *
     * @return string
     */
    public function getQueryStringParameters($url)
    {
        return $this->key;
    }
}