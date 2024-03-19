<?php

namespace App\Tests\Unit;

use App\Entity\Feedback;
use App\Entity\Infoday;
use App\Entity\Interest;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class FeedbackEntityTest extends TestCase
{
    public function getEntity(): Feedback
    {
        $user = new User();
        $user->setUsername('test')
             ->setPassword('test123')
             ->setFirstname('test')
             ->setLastname('test')
             ->setBirthday(new \DateTime('2021-01-01'))
             ->setInfoday(new Infoday(new \DateTime('2021-01-01')));

        $interest = new Interest();
        $interest->setName('Electronics');
        $feedback = new Feedback();
        $feedback->setRating(3)
                 ->setComment('test')
                 ->addInterest($interest)
                 ->setUser($user);
        return $feedback;
    }

    public function testRating(): void
    {
        $feedback = $this->getEntity();
        $feedback->setRating(5);
        $this->assertEquals(5, $feedback->getRating());
    }

    public function testComment(): void
    {
        $feedback = $this->getEntity();
        $feedback->setComment('good 2');
        $this->assertEquals('good 2', $feedback->getComment());
    }

    public function testId(): void
    {
        $feedback = $this->getEntity();
        $feedback->setId(0);
        $this->assertEquals(0, $feedback->getId());
    }

    /*public function testDateVisited(): void
    {
        $feedback = $this->getEntity();
        $feedback->setDatevisited(new Infoday(new \DateTime('2022-01-01')));
        $this->assertEquals(new Infoday(new \DateTime('2022-01-01')), $feedback->getDatevisited());
    }*/

    public function testInterest(): void
    {
        $feedback = $this->getEntity();
        $interest = new Interest();
        $interest->setName('Mechanics');
        $feedback->addInterest($interest);
        $this->assertCount(2, $feedback->getInterests());
    }

    public function testRemoveInterest(): void
    {
        $feedback = $this->getEntity();
        $feedback->removeInterest($feedback->getInterests()[0]);

        $this->assertCount(0, $feedback->getInterests());
    }

    public function testGetUser(): void
    {
        $feedback = new Feedback();
        $user = new User();

        $feedback->setUser($user);
        $this->assertEquals($user, $feedback->getUser());
    }
}
