<?php

namespace TeamPickr\DistanceMatrix\Tests;

use PHPUnit\Framework\TestCase;
use TeamPickr\DistanceMatrix\DistanceMatrix;
use TeamPickr\DistanceMatrix\Licenses\PremiumLicense;
use TeamPickr\DistanceMatrix\Licenses\StandardLicense;

class PremiumLicenseTest extends AbstractTestCase
{
    /** @test */
    public function can_make_premium_license()
    {
        $license = new PremiumLicense(getenv('GOOGLE_MAPS_CLIENT_ID'), getenv('GOOGLE_MAPS_ENC_KEY'));

        $distanceMatrix = (new DistanceMatrix($license))
            ->addOrigin('norwich,gb')
            ->addDestination('ipswich,gb');

        $this->makeTestRequest($distanceMatrix)->request();

        $request = $this->container[0]['request'];

        $this->assertContains("signature=", $request->getUri()->getQuery());
        $this->assertContains("client=" . getenv('GOOGLE_MAPS_CLIENT_ID'), $request->getUri()->getQuery());
    }
}