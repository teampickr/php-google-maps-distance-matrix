<?php

namespace TeamPickr\DistanceMatrix\Tests;

use PHPUnit\Framework\TestCase;
use TeamPickr\DistanceMatrix\DistanceMatrix;
use TeamPickr\DistanceMatrix\DistanceMatrixResponse;
use TeamPickr\DistanceMatrix\TravelMode;
use TeamPickr\DistanceMatrix\Licenses\StandardLicense;

class DistanceMatrixTest extends AbstractTestCase
{

    /**
     * @var string
     */
    protected $key;

    protected function setUp()
    {
        parent::setUp();

        $this->key = getenv('GOOGLE_MAPS_KEY');
    }

    /**
     * @return \TeamPickr\DistanceMatrix\DistanceMatrix
     */
    protected function newInstance()
    {
        return new DistanceMatrix(new StandardLicense($this->key));
    }

    /** @test */
    public function can_initialize_with_standard_license()
    {
        $this->assertInstanceOf(DistanceMatrix::class, $this->newInstance());
    }

    /** @test */
    public function can_add_origin()
    {
        $instance = $this->newInstance()->addOrigin("norwich,gb");

        $this->assertContains("norwich,gb", $instance->getOrigins());
    }

    /** @test */
    public function can_add_destination()
    {
        $instance = $this->newInstance()->addOrigin("ipswich,gb");

        $this->assertContains("ipswich,gb", $instance->getOrigins());
    }

    /** @test */
    public function default_mode_is_driving()
    {
        $this->assertEquals('driving', $this->newInstance()->getMode());
    }

    /** @test */
    public function can_set_mode()
    {
        $instance = $this->newInstance()->setMode(TravelMode::CYCLING);

        $this->assertEquals('bicycling', $instance->getMode());
    }

    /** @test */
    public function can_make_request()
    {
        $request = $this->newInstance()->addOrigin('norwich,gb')
            ->addDestination('ipswich,gb')
            ->request();

        $this->assertInstanceOf(DistanceMatrixResponse::class, $request);
    }
}