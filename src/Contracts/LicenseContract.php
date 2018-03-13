<?php

namespace TeamPickr\DistanceMatrix\Contracts;

use GuzzleHttp\Psr7\Request;

/**
 * Interface LicenseContract
 *
 * @package TeamPickr\DistanceMatrix\Contracts
 */
interface LicenseContract
{
    public function getQueryStringParameters(Request $request);
}