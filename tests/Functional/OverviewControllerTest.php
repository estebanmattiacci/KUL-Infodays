<?php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OverviewControllerTest extends WebTestCase
{
    public function testFeedbacks(): void
    {
        $client = static::createClient();

        $entityManager = $client->getContainer()->get('doctrine')->getManager();
        $user = $entityManager->getRepository('App\Entity\User')->find(20);
        $client->loginUser($user);

        $client->request('GET', '/overview/feedbacks');
        $this->assertResponseIsSuccessful();

    }

    public function testStatistics(): void
    {
        $client = static::createClient();

        $entityManager = $client->getContainer()->get('doctrine')->getManager();
        $user = $entityManager->getRepository('App\Entity\User')->find(15);
        $client->loginUser($user);

        $client->request('GET', '/overview/statistics');
        $this->assertResponseIsSuccessful();

    }
}
