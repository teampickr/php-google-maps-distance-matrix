<?php

namespace TeamPickr\DistanceMatrix\Tests;

use DateTime;
use TeamPickr\DistanceMatrix\Response\DistanceMatrixResponse;
use TeamPickr\DistanceMatrix\Response\Element;
use TeamPickr\DistanceMatrix\TrafficModel;
use TeamPickr\DistanceMatrix\TransitMode;
use TeamPickr\DistanceMatrix\TransitRouting;

class DistanceMatrixRequestTest extends AbstractTestCase
{
    /** @test */
    public function adds_language_to_request()
    {
        $distanceMatrix = $this->newInstance()
            ->addOrigin('norwich,gb')
            ->addDestination('ipswich,gb')
            ->setLanguage('en-GB');

        $this->makeTestRequest($distanceMatrix, $this->makeSuccessfulMockHandler())->request();

        $request = $this->container[0]['request'];

        $this->assertContains("language=en-GB", $request->getUri()->getQuery());
    }

    /** @test */
    public function adds_arrival_time_to_request()
    {
        $date = new DateTime('2019-01-01 15:00:00');

        $distanceMatrix = $this->newInstance()
            ->addOrigin('norwich,gb')
            ->addDestination('ipswich,gb')
            ->setArrivalTime($date);

        $this->makeTestRequest($distanceMatrix, $this->makeSuccessfulMockHandler())->request();

        $request = $this->container[0]['request'];

        $this->assertContains("arrival_time=" . $date->getTimestamp(), $request->getUri()->getQuery());
    }

    /** @test */
    public function adds_departure_time_to_request()
    {
        $date = new DateTime('2019-01-02 15:00:00');

        $distanceMatrix = $this->newInstance()
            ->addOrigin('norwich,gb')
            ->addDestination('ipswich,gb')
            ->setDepartureTime($date);

        $this->makeTestRequest($distanceMatrix, $this->makeSuccessfulMockHandler())->request();

        $request = $this->container[0]['request'];

        $this->assertContains("departure_time=" . $date->getTimestamp(), $request->getUri()->getQuery());
    }

    /** @test */
    public function adds_traffic_model_to_request()
    {
        $distanceMatrix = $this->newInstance()
            ->addOrigin('norwich,gb')
            ->addDestination('ipswich,gb')
            ->setTrafficModel(TrafficModel::OPTIMISTIC);

        $this->makeTestRequest($distanceMatrix, $this->makeSuccessfulMockHandler())->request();

        $request = $this->container[0]['request'];

        $this->assertContains("traffic_model=optimistic", $request->getUri()->getQuery());
    }

    /** @test */
    public function adds_avoid_to_request()
    {
        $distanceMatrix = $this->newInstance()
            ->addOrigin('norwich,gb')
            ->addDestination('ipswich,gb')
            ->avoidHighways();

        $this->makeTestRequest($distanceMatrix, $this->makeSuccessfulMockHandler())->request();

        $request = $this->container[0]['request'];

        $this->assertContains("avoid=highways", $request->getUri()->getQuery());
    }

    /** @test */
    public function adds_transit_mode_to_request()
    {
        $distanceMatrix = $this->newInstance()
            ->addOrigin('norwich,gb')
            ->addDestination('ipswich,gb')
            ->addTransitMode(TransitMode::RAIL)
            ->addTransitMode(TransitMode::BUS);

        $this->makeTestRequest($distanceMatrix, $this->makeSuccessfulMockHandler())->request();

        $request = $this->container[0]['request'];

        $this->assertContains("transit_mode=" . urlencode("rail|bus"), $request->getUri()->getQuery());
    }

    /** @test */
    public function adds_transit_routing_preference_request()
    {
        $distanceMatrix = $this->newInstance()
            ->addOrigin('norwich,gb')
            ->addDestination('ipswich,gb')
            ->addTransitMode(TransitMode::RAIL)
            ->setTransitRoutingPreference(TransitRouting::LESS_WALKING);

        $this->makeTestRequest($distanceMatrix, $this->makeSuccessfulMockHandler())->request();

        $request = $this->container[0]['request'];

        $this->assertContains("transit_mode=rail", $request->getUri()->getQuery());
        $this->assertContains("transit_routing_preference=less_walking", $request->getUri()->getQuery());
    }

    /** @test */
    public function adds_units_to_request()
    {
        $distanceMatrix = $this->newInstance()
            ->addOrigin('norwich,gb')
            ->addDestination('ipswich,gb')
            ->useMetricUnits();

        $this->makeTestRequest($distanceMatrix, $this->makeSuccessfulMockHandler())->request();

        $request = $this->container[0]['request'];

        $this->assertContains("units=metric", $request->getUri()->getQuery());
    }

    /** @test */
    public function adds_region_to_request()
    {
        $distanceMatrix = $this->newInstance()
            ->addOrigin('norwich,gb')
            ->addDestination('ipswich,gb')
            ->setRegion('GB');

        $this->makeTestRequest($distanceMatrix, $this->makeSuccessfulMockHandler())->request();

        $request = $this->container[0]['request'];

        $this->assertContains("region=GB", $request->getUri()->getQuery());
    }

    /** @test */
    public function can_make_request()
    {
        $distanceMatrix = $this->newInstance()->addOrigin('norwich,gb')
            ->addDestination('ipswich,gb');

        $response = $this->makeTestRequest($distanceMatrix, $this->makeSuccessfulMockHandler())->request();

        $element = $response->rows()[0]->elements()[0];

        $this->assertInstanceOf(DistanceMatrixResponse::class, $response);
        $this->assertInstanceOf(Element::class, $element);
        $this->assertTrue($response->successful());
        $this->assertNotNull($response->successful());
    }
}