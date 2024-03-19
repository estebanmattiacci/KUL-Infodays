<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProfileControllerTest extends WebTestCase
{
    public function testProfile(): void
    {
        $client = static::createClient();


        // Login as an existing user
        $entityManager = $client->getContainer()->get('doctrine')->getManager();

        $user = $entityManager->getRepository('App\Entity\User')->find(14);
        $client->loginUser($user);
        $client->request('GET', '/profile');
        $this->assertResponseIsSuccessful();

    }
}
