<?php

namespace Teampickr\DistanceMatrix;

use Teampickr\DistanceMatrix\Contracts\LicenseContract;

class DistanceMatrix
{
    protected $license;

    public function __construct(LicenseContract $license)
    {
        $this->license = $license;
    }

    /**
     * @return LicenseContract
     */
    public function getLicense(): LicenseContract
    {
        return $this->license;
    }

    /**
     * @param LicenseContract $license
     */
    public function setLicense(LicenseContract $license): void
    {
        $this->license = $license;
    }

}