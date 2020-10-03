<?php

namespace TeamPickr\DistanceMatrix\Tests;

use Dotenv\Dotenv;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use TeamPickr\DistanceMatrix\DistanceMatrix;
use TeamPickr\DistanceMatrix\Licenses\StandardLicense;
use TeamPickr\DistanceMatrix\Request\DistanceMatrixRequest;

abstract class AbstractTestCase extends TestCase
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var array
     */
    protected $container = [];

    protected function setUp(): void
    {
        parent::setUp();

        require __DIR__ . '/../vendor/autoload.php';

        if (file_exists(__DIR__ . '/../.env')) {
            (Dotenv::createImmutable('/../'))->load();
        }

        $this->key = getenv('GOOGLE_MAPS_KEY');
    }

    /**
     * @return DistanceMatrix
     */
    public function newInstance()
    {
        return new DistanceMatrix(new StandardLicense($this->key));
    }

    /**
     * @param DistanceMatrix                  $distanceMatrix
     * @param \GuzzleHttp\Handler\MockHandler $mockHandler
     *
     * @return DistanceMatrixRequest
     */
    public function makeTestRequest(DistanceMatrix $distanceMatrix, MockHandler $mockHandler = null)
    {
        return (new DistanceMatrixRequest($distanceMatrix, $mockHandler))
            ->pushMiddleware(Middleware::history($this->container));
    }

    /**
     * @return \GuzzleHttp\Handler\MockHandler
     */
    public function makeSuccessfulMockHandler()
    {
        return new MockHandler([
            new Response(200, [], file_get_contents(__DIR__ . '/responses/norwich_to_ipswich.json')),
        ]);
    }


    /**
     * @return \GuzzleHttp\Handler\MockHandler
     */
    public function makeSuccessfulWithDurationInTrafficMockHandler()
    {
        return new MockHandler([
            new Response(200, [], file_get_contents(__DIR__ . '/responses/with_duration_in_traffic.json')),
        ]);
    }

}