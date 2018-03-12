<?php

namespace Teampickr\DistanceMatrix\Contracts;

/**
 * Interface LicenseContract
 *
 * @package Teampickr\DistanceMatrix\Contracts
 */
interface LicenseContract
{
    public function getQueryStringParameters($url);
}