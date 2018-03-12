<?php

namespace Teampickr\DistanceMatrix;

use Teampickr\DistanceMatrix\Contracts\LicenseContract;

class DistanceMatrix
{
    /**
     * @var LicenseContract
     */
    protected $license;

    /**
     * @var array
     */
    protected $origins = [];

    /**
     * @var array
     */
    protected $destinations = [];

    /**
     * @var string
     */
    protected $mode = TravelMode::DRIVING;

    /**
     * DistanceMatrix constructor.
     *
     * @param LicenseContract $license
     */
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
     *
     * @return \Teampickr\DistanceMatrix\DistanceMatrix
     */
    public function setLicense(LicenseContract $license)
    {
        $this->license = $license;

        return $this;
    }

    /**
     * @param string $origin
     *
     * @return $this
     */
    public function addOrigin(string $origin)
    {
        $this->origins[] = $origin;

        return $this;
    }

    /**
     * @return array
     */
    public function getOrigins(): array
    {
        return $this->origins;
    }

    /**
     * @param string $destination
     *
     * @return $this
     */
    public function addDestination(string $destination)
    {
        $this->destinations[] = $destination;

        return $this;
    }

    /**
     * @return array
     */
    public function getDestinations(): array
    {
        return $this->destinations;
    }

    /**
     * @return string
     */
    public function getMode(): string
    {
        return $this->mode;
    }

    /**
     * @param string $mode
     *
     * @return \Teampickr\DistanceMatrix\DistanceMatrix
     */
    public function setMode(string $mode)
    {
        $this->mode = $mode;

        return $this;
    }

}