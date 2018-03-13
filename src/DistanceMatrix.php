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
     * @var string
     */
    protected $units = null;

    /**
     * @var string
     */
    protected $region = null;

    /**
     * @var string
     */
    protected $avoid = null;

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
     * @var array
     */
    protected $transitMode = [];

    /**
     * @var string
     */
    protected $transitRoutingPreference = null;

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
     * @param \TeamPickr\DistanceMatrix\Contracts\LicenseContract $license
     *
     * @return static
     */
    public static function license(LicenseContract $license)
    {
        return new static($license);
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
     * @return DistanceMatrix
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
     * @return DistanceMatrix
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
     * @return DistanceMatrix
     */
    public function setTrafficModel(string $trafficModel)
    {
        $this->trafficModel = $trafficModel;

        return $this;
    }

    /**
     * @return array
     */
    public function getTransitMode()
    {
        return $this->transitMode;
    }

    /**
     * @param string $transitMode
     *
     * @return DistanceMatrix
     */
    public function addTransitMode(string $transitMode)
    {
        $this->transitMode[] = $transitMode;

        return $this;
    }

    /**
     * @return string
     */
    public function getTransitRoutingPreference()
    {
        return $this->transitRoutingPreference;
    }

    /**
     * @param string $transitRoutingPreference
     *
     * @return DistanceMatrix
     */
    public function setTransitRoutingPreference(string $transitRoutingPreference)
    {
        $this->transitRoutingPreference = $transitRoutingPreference;

        return $this;
    }

    /**
     * @return string
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * @param string $units
     *
     * @return DistanceMatrix
     */
    public function setUnits(string $units)
    {
        $this->units = $units;

        return $this;
    }

    /**
     * @return DistanceMatrix
     */
    public function useMetricUnits()
    {
        return $this->setUnits(Unit::METRIC);
    }

    /**
     * @return DistanceMatrix
     */
    public function useImperialUnits()
    {
        return $this->setUnits(Unit::IMPERIAL);
    }

    /**
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param string $region
     *
     * @return DistanceMatrix
     */
    public function setRegion(string $region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return string
     */
    public function getAvoid()
    {
        return $this->avoid;
    }

    /**
     * @param string $avoid
     *
     * @return DistanceMatrix
     */
    public function setAvoid(string $avoid)
    {
        $this->avoid = $avoid;

        return $this;
    }

    /**
     * @return \TeamPickr\DistanceMatrix\DistanceMatrix
     */
    public function avoidTolls()
    {
        return $this->setAvoid(Avoid::TOLLS);
    }

    /**
     * @return \TeamPickr\DistanceMatrix\DistanceMatrix
     */
    public function avoidHighways()
    {
        return $this->setAvoid(Avoid::HIGHWAYS);
    }

    /**
     * @return \TeamPickr\DistanceMatrix\DistanceMatrix
     */
    public function avoidFerries()
    {
        return $this->setAvoid(Avoid::FERRIES);
    }

    /**
     * @return \TeamPickr\DistanceMatrix\DistanceMatrix
     */
    public function avoidIndoor()
    {
        return $this->setAvoid(Avoid::INDOOR);
    }

}