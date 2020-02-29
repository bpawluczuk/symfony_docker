<?php

namespace App\LocalizationModule\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class LocalizationControllerTest extends WebTestCase
{
    public function testGetList()
    {
        $client = static::createClient();
        $client->request('GET', '/localization/list');
        $this->assertEquals(Response::HTTP_OK, $client->getResponse()->getStatusCode());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            )
        );

        $this->assertContains('status', $client->getResponse()->getContent());
        $this->assertContains('data', $client->getResponse()->getContent());
        $this->assertContains('name', $client->getResponse()->getContent());
        $this->assertContains('createAt', $client->getResponse()->getContent());
        $this->assertContains('updateAt', $client->getResponse()->getContent());
    }
}
