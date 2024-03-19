<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLogin(): void
    {
        $client = static::createClient();

        $client->request('GET', '/login');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testLogout(): void
    {
        $client = static::createClient();

        $client->request('GET', '/logout');
        $this->assertEquals(302, $client->getResponse()->getStatusCode());

    }
}