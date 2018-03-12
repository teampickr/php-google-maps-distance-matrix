<?php

namespace TeamPickr\DistanceMatrix\Tests;

use PHPUnit\Framework\TestCase;
use TeamPickr\DistanceMatrix\Licenses\StandardLicense;

class StandardLicenseTest extends TestCase
{
    /** @test */
    public function can_make_standard_license()
    {
        $license = new StandardLicense("key");

        $this->assertEquals("key", $license->getQueryStringParameters("https://google.com/"));
    }
}