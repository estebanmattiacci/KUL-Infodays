<?php

namespace App\Tests\Functional;

use App\Entity\User;
use App\Security\EmailVerifier;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class RegistrationControllerTest extends WebTestCase
{/*
    public function testRegisterPage()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/register');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertSelectorTextContains('h1', 'Info Days'); // Assuming the page contains an <h1> element with "Register"

        $form = $crawler->selectButton('Register')->form();

        $formData = [
            'registration_form[email]' => 'email@gmail.com',
            'registration_form[plainPassword]' => 'Password123',
            'registration_form[firstname]' => 'John',
            'registration_form[lastname]' => 'Doe',
            'registration_form[agreeTerms]' => '1',
            'registration_form[birthday]' => '1990-01-01',
            'registration_form[username]' => 'JohnDoe',
            'registration_form[infoday]' => "1",
        ];
        $client->submit($form, $formData);

        $this->assertResponseStatusCodeSame(Response::HTTP_FOUND);

        $client->followRedirect();

        // Check if the user is stored in the database
        $entityManager = self::getContainer()->get('doctrine.orm.entity_manager');
        $userRepository = $entityManager->getRepository(User::class);
        $testUser = $userRepository->findOneBy(['email' => 'email@gmail.com']);

        $this->assertNotNull($testUser);
        $this->assertSame('email@gmail.com', $testUser->getEmail());

        $entityManager->remove($testUser);
        $entityManager->flush();

    }*/
    
}
