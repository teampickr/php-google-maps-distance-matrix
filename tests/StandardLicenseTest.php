<?php

namespace TeamPickr\DistanceMatrix\Tests;

use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;
use TeamPickr\DistanceMatrix\Licenses\StandardLicense;

class StandardLicenseTest extends TestCase
{
    /** @test */
    public function can_make_standard_license()
    {
        $license = new StandardLicense("key");

        $this->assertEquals(['key' => 'key'],
            $license->getQueryStringParameters(new Request('GET', 'https://google.com/')));
    }
}