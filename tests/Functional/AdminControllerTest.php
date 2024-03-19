<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AdminControllerTest extends WebTestCase
{
    public function testAdminUserVerified(): void
    {
        $client = static::createClient();
        $entityManager = $client->getContainer()->get('doctrine')->getManager();

        // Login as an existing user
        $user = $entityManager->getRepository('App\Entity\User')->find(9);
        $client->loginUser($user);

        $client->request('GET', '/admin');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function testAdminAccessDeniedForAnom()
    {
        $client = static::createClient();

        $client->request('GET', '/admin');
        //Redirect to login page
        $this->assertEquals(302, $client->getResponse()->getStatusCode());
    }
}
