<?php

namespace App\Tests\Unit;


use App\Entity\Feedback;
use App\Entity\Infoday;
use App\Entity\User;
use PHPUnit\Framework\TestCase;


class UserEntityTest extends TestCase
{
    public function getEntity() : User
    {
        $infoday = new Infoday(new \DateTime('2021-01-01'));
        return (new User())
            ->setId(1)
            ->setBirthday(new \DateTime('1999-01-01'))
            ->setEmail('test@gmail.com')
            ->setUsername('test')
            ->setFirstName('test')
            ->setLastName('test')
            ->setPassword('123456')
            ->setRoles(['ROLE_USER'])
            ->setIsVerified(true)
            ->setInfoday($infoday)
            ->setFeedback(new Feedback($infoday,3,'mechanics','good'));
    }
    public function testUsername(): void
    {
        $user = $this->getEntity();

        $this->assertEquals('test', $user->getUsername());

    }
    public function testEmail(): void
    {
        $user = $this->getEntity();

        $this->assertEquals('test@gmail.com', $user->getEmail());
    }

    public function testFirstName(): void
    {
        $user = $this->getEntity();

        $this->assertEquals('test', $user->getFirstName());
    }

    public function testLastName(): void
    {
        $user = $this->getEntity();

        $this->assertEquals('test', $user->getLastName());
    }

    public function testPassword(): void
    {
        $user = $this->getEntity();

        $this->assertEquals('123456', $user->getPassword());
    }

    public function testRoles(): void
    {
        $user = $this->getEntity();

        $this->assertEquals(['ROLE_USER'], $user->getRoles());
    }

    public function testIsVerified(): void
    {
        $user = $this->getEntity();

        $this->assertTrue($user->IsVerified());
    }

    public function testInfoday(): void
    {
        $user = $this->getEntity();

        $this->assertEquals(new Infoday(new \DateTime('2021-01-01')), $user->getInfoday());
    }

    public function testBirthday(): void
    {
        $user = $this->getEntity();

        $this->assertEquals(new \DateTime('1999-01-01'), $user->getBirthday());
    }

    public function testFeedback(): void
    {
        $user = $this->getEntity();

        $this->assertEquals(new Feedback(new Infoday(new \DateTime('2021-01-01')),3,'mechanics','good'), $user->getFeedback());
    }

    public function testUserIdentifier(): void
    {
        $user = $this->getEntity();

        $this->assertEquals('test@gmail.com', $user->getUserIdentifier());
    }

    public function testId(): void
    {
        $user = $this->getEntity();

        $this->assertEquals(1, $user->getId());
    }
}
