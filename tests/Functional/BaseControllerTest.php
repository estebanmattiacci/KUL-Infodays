<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BaseControllerTest extends WebTestCase
{
    public function testHome(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        // Login as an existing user
        $entityManager = $client->getContainer()->get('doctrine')->getManager();

        $user = $entityManager->getRepository('App\Entity\User')->find(15);
        $client->loginUser($user);

        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testHomeUnverified(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        // Login as an existing user
        $entityManager = $client->getContainer()->get('doctrine')->getManager();

        $user = $entityManager->getRepository('App\Entity\User')->find(9);
        $client->loginUser($user);

        $client->request('GET', '/admin');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testContacts(): void
    {
        $client = static::createClient();
        $client->request('GET', '/contact');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
