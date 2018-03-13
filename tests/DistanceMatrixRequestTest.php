<?php

namespace TeamPickr\DistanceMatrix\Tests;

use DateTime;
use TeamPickr\DistanceMatrix\Response\DistanceMatrixResponse;
use TeamPickr\DistanceMatrix\Response\Element;
use TeamPickr\DistanceMatrix\TrafficModel;

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