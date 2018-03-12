<?php

namespace TeamPickr\DistanceMatrix\Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

abstract class AbstractTestCase extends TestCase
{
    protected function setUp()
    {
        parent::setUp();

        require __DIR__ . '/../vendor/autoload.php';

        (new Dotenv(__DIR__ . '/../'))->load();
    }

}