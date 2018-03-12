<?php

namespace Teampickr\DistanceMatrix\Licenses;

use Teampickr\DistanceMatrix\Contracts\LicenseContract;

/**
 * Class StandardLicense
 *
 * @package Teampickr\DistanceMatrix\Licenses
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
     * @return string
     */
    public function __toString()
    {
        return $this->key;
    }
}