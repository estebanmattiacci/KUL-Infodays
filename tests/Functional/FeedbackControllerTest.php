<?php

namespace App\Tests\Functional;

use App\Entity\Feedback;
use App\Entity\Infoday;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FeedbackControllerTest extends WebTestCase
{

    private $client;

    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
    }

    public function testUnauthenticatedUserCannotAccessFeedbackPage()
    {
        $this->client->request('GET', '/feedback');
        $this->assertResponseRedirects('/login');
    }

    public function testAuthenticatedUserCanAccessFeedbackPage()
    {
        $entityManager = $this->client->getContainer()->get('doctrine')->getManager();

        // Login as an existing user
        $user = $entityManager->getRepository('App\Entity\User')->find(28);
        $this->client->loginUser($user);

        $this->client->request('GET', '/feedback');
        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());
    }

    public function testSubmittingValidFeedback()
    {
        //create a new user
        $user = new User();
        $user->setEmail('test@fjt.com')
            ->setInfoday($this->client->getContainer()->get('doctrine')->getManager()->getRepository(Infoday::class)->find(1))
            ->setPassword('test')
            ->setIsVerified(true)
            ->setUsername('test')
            ->setFirstname('test')
            ->setLastname('test')
            ->setBirthday(new \DateTime(2001-01-01));

        //user should be in the database but make sure I can run the test multiple times without having to delete the user


        $entityManager = $this->client->getContainer()->get('doctrine')->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        // Log in as the new user
        $this->client->loginUser($user);

        //Submit a feedback form
        $crawler = $this->client->request('GET', '/feedback');
        $this->assertEquals(200, $this->client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('Submit')->form();
        $formData = [
            'feedback[rating]' => 3,
            'feedback[comment]' => 'Test User',
            'feedback[interests]' => [1,2,3],

        ];
        $this->client->submit($form, $formData);    

        $this->assertEquals(302, $this->client->getResponse()->getStatusCode());



    }

    protected function tearDown(): void
    {
        $entityManager = $this->client->getContainer()->get('doctrine')->getManager();

        // Find the user by email
        $user = $entityManager->getRepository(User::class)->findOneBy(['email' => 'test@fjt.com']);

        if ($user) {
            $feedback = $user->getFeedback();

            if ($feedback) {
                $user->setFeedback(null);
                $entityManager->remove($feedback);
            }

            $entityManager->remove($user);
            $entityManager->flush();
        }

        parent::tearDown();
    }
}
