<?php

namespace App\System\Main\Location\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class LocationControllerTest
 * @package App\System\Main\Location\Tests\Functional
 * @author Borys Pawluczuk
 */
class LocationControllerTest extends WebTestCase
{
    public function testGetList()
    {
        $client = static::createClient();
        $client->request('GET', '/api/location/list');
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertContains('data', $client->getResponse()->getContent());
        $this->assertContains('main', $client->getResponse()->getContent());
        $this->assertContains('name', $client->getResponse()->getContent());
        $this->assertContains('status', $client->getResponse()->getContent());
        $this->assertContains('created_at', $client->getResponse()->getContent());
        $this->assertContains('updated_at', $client->getResponse()->getContent());
    }
}
