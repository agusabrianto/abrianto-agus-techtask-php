<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LunchControllerTest extends WebTestCase
{
    public function testLunch()
    {
        $client = static::createClient();

        $client->request('POST', '/lunch');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}