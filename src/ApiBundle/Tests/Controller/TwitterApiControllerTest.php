<?php

namespace ApiBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TwitterApiControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/twitter/nicklaus_');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //$this->assertContains('Testing api/twitter/nicklaus_ endpoint', $crawler->filter('"name": "nicklaus_"')->text());

    }
}
