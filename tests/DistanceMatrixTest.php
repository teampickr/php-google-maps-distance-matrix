<?php

namespace Teampickr\DistanceMatrix\Tests;

use PHPUnit\Framework\TestCase;
use Teampickr\DistanceMatrix\DistanceMatrix;
use Teampickr\DistanceMatrix\Licenses\StandardLicense;

class DistanceMatrixTest extends TestCase
{
    /** @test */
    public function can_initialize_with_standard_license()
    {
        $instance = new DistanceMatrix(new StandardLicense("key"));

        $this->assertInstanceOf(DistanceMatrix::class, $instance);
    }
}