<?php

namespace TeamPickr\DistanceMatrix\Tests;

use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Psr7\Response;
use TeamPickr\DistanceMatrix\DistanceMatrix;
use TeamPickr\DistanceMatrix\Licenses\PremiumLicense;

class PremiumLicenseTest extends AbstractTestCase
{
    /** @test */
    public function can_make_premium_license()
    {
        $license = new PremiumLicense(getenv('GOOGLE_MAPS_CLIENT_ID'), getenv('GOOGLE_MAPS_ENC_KEY'));

        $distanceMatrix = (new DistanceMatrix($license))
            ->addOrigin('norwich,gb')
            ->addDestination('ipswich,gb');

        $mock = new MockHandler([new Response(200)]);

        $this->makeTestRequest($distanceMatrix, $mock)->request();

        $request = $this->container[0]['request'];

        $this->assertStringContainsString("signature=", $request->getUri()->getQuery());
        $this->assertStringContainsString("client=" . getenv('GOOGLE_MAPS_CLIENT_ID'), $request->getUri()->getQuery());
    }
}