<?php

namespace Teampickr\DistanceMatrix\Tests;

use PHPUnit\Framework\TestCase;
use Teampickr\DistanceMatrix\DistanceMatrix;
use Teampickr\DistanceMatrix\TravelMode;
use Teampickr\DistanceMatrix\Licenses\StandardLicense;

class DistanceMatrixTest extends TestCase
{
    /**
     * @return \Teampickr\DistanceMatrix\DistanceMatrix
     */
    protected function newInstance()
    {
        return new DistanceMatrix(new StandardLicense("key"));
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
}