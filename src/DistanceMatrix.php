<?php

namespace TeamPickr\DistanceMatrix;

use DateTime;
use TeamPickr\DistanceMatrix\Contracts\LicenseContract;
use TeamPickr\DistanceMatrix\Request\DistanceMatrixRequest;
use TeamPickr\DistanceMatrix\Response\DistanceMatrixResponse;

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
     * @var null|string
     */
    protected $language = null;

    /**
     * @var null|int
     */
    protected $arrivalTime = null;

    /**
     * @var null|int
     */
    protected $departureTime = null;

    /**
     * @var string
     */
    protected $trafficModel = null;

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
     * @return DistanceMatrix
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
     * @return DistanceMatrix
     */
    public function setMode(string $mode)
    {
        $this->mode = $mode;

        return $this;
    }

    /**
     * @return DistanceMatrixResponse
     */
    public function request()
    {
        return (new DistanceMatrixRequest($this))->request();
    }

    /**
     * @return null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param null $language
     *
     * @return DistanceMatrix
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * @return null
     */
    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    /**
     * @param int|\DateTime $arrivalTime
     *
     * @return \TeamPickr\DistanceMatrix\DistanceMatrix
     */
    public function setArrivalTime($arrivalTime)
    {
        if ($arrivalTime instanceof DateTime) {
            $this->arrivalTime = $arrivalTime->getTimestamp();
        } else {
            $this->arrivalTime = $arrivalTime;
        }

        return $this;
    }

    /**
     * @return null
     */
    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    /**
     * @param null $departureTime
     *
     * @return \TeamPickr\DistanceMatrix\DistanceMatrix
     */
    public function setDepartureTime($departureTime)
    {
        if ($departureTime instanceof DateTime) {
            $this->departureTime = $departureTime->getTimestamp();
        } else {
            $this->departureTime = $departureTime;
        }

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTrafficModel()
    {
        return $this->trafficModel;
    }

    /**
     * @param string $trafficModel
     *
     * @return \TeamPickr\DistanceMatrix\DistanceMatrix
     */
    public function setTrafficModel(string $trafficModel)
    {
        $this->trafficModel = $trafficModel;

        return $this;
    }

}